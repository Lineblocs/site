<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Workspace;
use App\Helpers\WorkspaceInvoiceHelper;

class SendWorkspaceInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:send-workspace-owner {--workspace_id=} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly and annual invoices and send them to workspace owner(s)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $workspaces = $this->getTargetWorkspaces();
        if ($workspaces->count() === 0) {
            $this->info('No matching workspaces found.');
            return;
        }

        $sent = 0;
        foreach ($workspaces as $workspace) {
            try {
                $owner = $workspace->creatorUser;
                if (!$owner || empty($owner->email)) {
                    $this->warn(sprintf('Skipping workspace #%d (owner missing email).', $workspace->id));
                    continue;
                }

                WorkspaceInvoiceHelper::sendInvoiceForWorkspace($workspace, 'MONTHLY', $owner);
                WorkspaceInvoiceHelper::sendInvoiceForWorkspace($workspace, 'ANNUAL', $owner);

                $sent++;
                $this->info(sprintf('Sent invoices to %s (workspace #%d).', $owner->email, $workspace->id));
            } catch (\Exception $ex) {
                $this->error(sprintf('Failed workspace #%d: %s', $workspace->id, $ex->getMessage()));
            }
        }

        $this->info(sprintf('Done. Sent %d email(s).', $sent));
    }

    private function getTargetWorkspaces()
    {
        $query = Workspace::query()->with('creatorUser');
        $workspaceId = $this->option('workspace_id');
        $email = $this->option('email');

        if (!empty($workspaceId)) {
            $query->where('id', $workspaceId);
        }

        if (!empty($email)) {
            $owner = User::where('email', $email)->first();
            if (!$owner) {
                return collect([]);
            }
            $query->where('creator_id', $owner->id);
        }

        return $query->get();
    }
}
