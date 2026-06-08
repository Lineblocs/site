<?php

namespace App\Console\Commands;

use App\Subscription;
use DateTime;
use DB;
use Illuminate\Console\Command;

class ApplyScheduledPlanUpgradesCommand extends Command
{
    protected $signature = 'billing:apply-scheduled-plan-upgrades {--now=} {--limit=100}';
    protected $description = 'Activate scheduled subscription plan upgrades at the billing cycle anchor';

    public function handle()
    {
        $now = $this->option('now');
        if (empty($now)) {
            $now = (new DateTime())->format('Y-m-d H:i:s');
        }

        $limit = (int) $this->option('limit');
        if ($limit <= 0) {
            $limit = 100;
        }

        $subscriptions = Subscription::whereNotNull('scheduled_plan_id')
            ->whereNotNull('scheduled_effective_date')
            ->where('scheduled_effective_date', '<=', $now)
            ->orderBy('scheduled_effective_date', 'asc')
            ->take($limit)
            ->get();

        $migrated = 0;

        foreach ($subscriptions as $queuedSubscription) {
            $didMigrate = DB::transaction(function () use ($queuedSubscription) {
                $subscription = Subscription::where('id', $queuedSubscription->id)
                    ->lockForUpdate()
                    ->first();

                if (!$subscription || empty($subscription->scheduled_plan_id)) {
                    return false;
                }

                $subscription->current_plan_id = $subscription->scheduled_plan_id;
                $subscription->scheduled_plan_id = null;
                $subscription->scheduled_effective_date = null;
                $subscription->save();

                return true;
            });

            if ($didMigrate) {
                $migrated++;
                $this->info('Activated scheduled plan for subscription #' . $queuedSubscription->id);
            }
        }

        $this->info('Scheduled plan upgrades activated: ' . $migrated);
    }
}
