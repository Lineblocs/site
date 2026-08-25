<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use App\CustomizationsKVStore;
use Carbon\Carbon;
use Exception;

class PerformPrivateGitUpdate extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $tries = 1;
    public $timeout = 600;

    public function handle(): void
    {
        Log::info('Starting private repository update...');

        $kvStore = new CustomizationsKVStore();
        $customizations = $kvStore->getRecord();

        $automaticModuleUpdates = filter_var($customizations['automatic_module_updates'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $automaticSecurityUpdates = filter_var($customizations['automatic_security_updates'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if (!$automaticModuleUpdates && !$automaticSecurityUpdates) {
            Log::info('Automatic module/security updates are disabled. Skipping update.');
            return;
        }

        $maintenanceWindowDay = $customizations['maintenance_window_day'] ?? null;
        $maintenanceWindowTime = $customizations['maintenance_window_time'] ?? null;

        if ($maintenanceWindowDay && $maintenanceWindowTime) {
            $now = Carbon::now();

            if (strcasecmp($now->format('l'), $maintenanceWindowDay) !== 0) {
                Log::info("Today ({$now->format('l')}) is not within the maintenance window day ({$maintenanceWindowDay}). Skipping update.");
                return;
            }

            $windowParts = explode('-', $maintenanceWindowTime);
            if (count($windowParts) === 2) {
                $startTime = Carbon::parse(trim($windowParts[0]));
                $endTime = Carbon::parse(trim($windowParts[1]));

                if (!$now->between($startTime, $endTime)) {
                    Log::info("Current time ({$now->format('H:i')}) is outside the maintenance window ({$maintenanceWindowTime}). Skipping update.");
                    return;
                }
            }
        }

        $repoUrl = config('services.git.repo_url'); // e.g., github.com/your-org/your-repo.git
        $username = config('services.git.username');
        $token = env('GIT_ACCESS_TOKEN');

        if (!$repoUrl || !$username || !$token) {
            throw new Exception('Git repository credentials or GIT_ACCESS_TOKEN are not properly configured.');
        }

        // Construct authenticated HTTPS URL dynamically: https://username:token@hostname/path.git
        $parsedUrl = parse_url($repoUrl);
        $hostAndPath = ($parsedUrl['host'] ?? '') . ($parsedUrl['path'] ?? '');
        $authenticatedUrl = "https://{$username}:{$token}@{$hostAndPath}";

        try {
            // 1. Put application into maintenance mode
            $this->runCommand(['php', 'artisan', 'down']);

            // 2. Configure the remote URL with embedded credentials temporarily
            $this->runCommand(['git', 'remote', 'set-url', 'origin', $authenticatedUrl]);

            // 3. Fetch latest changes from the remote server
            $this->runCommand(['git', 'fetch', 'origin']);

            // 4. Reset local codebase to match the latest remote branch
            $this->runCommand(['git', 'reset', '--hard', 'origin/main']);

            // 5. Install/update composer dependencies for the new code
            $this->runCommand(['composer', 'install', '--no-interaction', '--prefer-dist', '--optimize-autoloader']);

            // 6. Run database migrations
            $this->runCommand(['php', 'artisan', 'migrate', '--force']);

            // 7. Clear and rebuild caches
            $this->runCommand(['php', 'artisan', 'config:clear']);
            $this->runCommand(['php', 'artisan', 'cache:clear']);

            Log::info('Private repository update completed successfully.');

        } catch (Exception $e) {
            Log::error('Private repo update failed: ' . $e->getMessage());
            throw $e;
        } finally {
            // 8. Security cleanup: Strip credentials immediately back to clean URL
            $cleanUrl = "https://{$hostAndPath}";
            $this->runCommand(['git', 'remote', 'set-url', 'origin', $cleanUrl]);

            // 9. Bring application back up
            $this->runCommand(['php', 'artisan', 'up']);
        }
    }

    protected function runCommand(array $command): void
    {
        $process = new Process($command, base_path());
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new Exception("Command failed: " . $process->getErrorOutput());
        }
    }
}