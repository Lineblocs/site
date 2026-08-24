<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\CustomizationsKVStore;
use App\Helpers\EmailHelper;
use DateTime;
use Exception;

class MigrateBillingStrategy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:migrate-strategy {--dry-run : Simulate the run without persisting changes or sending emails}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill historical subscription billing dates using raw database selects, PHP logic, and EmailHelper.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->warn('--- DRY RUN MODE ENABLED (No database updates or emails will be sent) ---');
        }

        $this->info('Starting historical subscription billing date backfill...');
        Log::info('Starting MigrateBillingStrategy Artisan Command.');

        try {
            // Retrieve global customizations from the \App namespace
            $customizations = CustomizationsKVStore::getRecord();
            $billingFlow = $customizations['billing_flow'] ?? 'ANNUAL';
            $trialDurationDays = (int) ($customizations['trial_duration_days'] ?? 14);
            $isTrialEnabledGlobal = $customizations['is_trial_enabled'] ?? false;

            $this->info("Global Billing Flow: {$billingFlow}");

            // Fetch subscriptions, plans, workspaces, and workspace owners using DB query builder
            $subscriptions = DB::table('subscriptions')
                ->leftJoin('service_plans', 'subscriptions.service_plan_id', '=', 'service_plans.id')
                ->leftJoin('workspaces', 'subscriptions.workspace_id', '=', 'workspaces.id')
                ->leftJoin('users', 'workspaces.creator_id', '=', 'users.id')
                ->select(
                    'subscriptions.*',
                    'service_plans.free_trial_exempt',
                    'workspaces.id as workspace_id',
                    'users.id as owner_id',
                    'users.email as owner_email',
                    'users.name as owner_name'
                )
                ->get();

            $totalCount = count($subscriptions);
            if ($totalCount === 0) {
                $this->info('No subscriptions found to process.');
                return Command::SUCCESS;
            }

            $bar = $this->output->createProgressBar($totalCount);
            $bar->start();

            $migratedCount = 0;
            $emailCount = 0;

            DB::beginTransaction();

            foreach ($subscriptions as $subscription) {
                try {
                    // Skip if anchor day and next billing date are already populated
                    if ($subscription->billing_anchor_day !== null && $subscription->next_billing_date !== null) {
                        $bar->advance();
                        continue;
                    }

                    $now = $subscription->created_at ? new DateTime($subscription->created_at) : new DateTime();
                    $anchorDay = (int)$now->format('j');

                    $isTrial = false;
                    if ($isTrialEnabledGlobal && !$subscription->free_trial_exempt) {
                        $isTrial = true;
                    }

                    $billingCycle = strtoupper($subscription->billing_cycle ?? 'MONTHLY');
                    if (!in_array($billingCycle, ['ANNUAL', 'MONTHLY'])) {
                        $billingCycle = 'MONTHLY';
                    }

                    // Replicate exact periodEnd calculation logic from userSpinup
                    if ($billingFlow === 'ANNUAL') {
                        if ($billingCycle === 'ANNUAL') {
                            $periodEnd = (clone $now)->modify('+1 year')->setTime(0, 0, 0);
                        } else {
                            // Look ahead to prevent native PHP +1 month edge-case rollover anomalies
                            $nextMonth = (clone $now)->modify('+1 month');
                            $daysInNextMonth = (int)$nextMonth->format('t');

                            if ($anchorDay > $daysInNextMonth) {
                                $periodEnd = $nextMonth->setDate((int)$nextMonth->format('Y'), (int)$nextMonth->format('n'), $daysInNextMonth)->setTime(0, 0, 0);
                            } else {
                                $periodEnd = (clone $now)->modify('+1 month')->setTime(0, 0, 0);
                            }
                        }
                    } else if ($billingFlow === 'ANNIVERSARY') {
                        if ($isTrial) {
                            if ($billingCycle === 'ANNUAL') {
                                $periodEnd = (clone $now)->modify('+1 year');
                            } else {
                                $periodEnd = (clone $now)->modify('+1 month');
                            }
                        } else {
                            $periodEnd = (clone $now)->modify(sprintf('+%d days', $trialDurationDays));
                        }
                    } else {
                        $periodEnd = (clone $now)->modify('+1 month');
                    }

                    $nextBillingDateStr = $periodEnd->format('Y-m-d');
                    $periodEndStr = $periodEnd->format('Y-m-d H:i:s');

                    $updateData = [
                        'billing_anchor_day' => $anchorDay,
                        'current_period_end' => $periodEndStr,
                        'next_billing_date'  => $nextBillingDateStr,
                        'updated_at'         => date('Y-m-d H:i:s'),
                    ];

                    if ($isTrial) {
                        $updateData['is_free_trial_active'] = 1;
                        $updateData['free_trial_start_date'] = $now->format('Y-m-d H:i:s');
                        $updateData['free_trial_end_date'] = $periodEndStr;
                    }

                    DB::table('subscriptions')
                        ->where('id', $subscription->id)
                        ->update($updateData);

                    $migratedCount++;

                    // Send email notification to workspace owner using EmailHelper
                    if (!empty($subscription->owner_email)) {
                        if (!$isDryRun) {
                            $emailData = [
                                'next_billing_date' => $nextBillingDateStr,
                                'workspace_id'      => $subscription->workspace_id,
                            ];

                            // Attempt to fetch user model if needed for subscription/preference checks
                            $ownerModel = \App\User::find($subscription->owner_id);
                            if ($ownerModel) {
                                $emailData['user'] = $ownerModel;
                            }

                            EmailHelper::sendEmail(
                                'Update Regarding Your Workspace Billing Schedule',
                                $subscription->owner_email,
                                'billing_date_update_announcement',
                                $emailData,
                                'SWIFT'
                            );
                        }
                        $emailCount++;
                    }

                    Log::info("Backfilled Subscription ID {$subscription->id} | Owner: {$subscription->owner_email} | Next Billing: {$nextBillingDateStr}");

                } catch (Exception $e) {
                    Log::error("Failed to process Subscription ID {$subscription->id}: " . $e->getMessage());
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            if ($isDryRun) {
                DB::rollBack();
                $this->info("Dry run complete. Processed {$migratedCount} records and prepared {$emailCount} emails (Rolled back).");
            } else {
                DB::commit();
                $this->info("Successfully backfilled {$migratedCount} subscription records and dispatched {$emailCount} notification emails.");
            }

            return Command::SUCCESS;

        } catch (Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            $this->error("Fatal error executing command: " . $e->getMessage());
            Log::error("Fatal error in MigrateBillingStrategy: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}