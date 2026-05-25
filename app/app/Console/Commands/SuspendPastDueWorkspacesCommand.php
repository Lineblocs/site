<?php

namespace App\Console\Commands;

use App\Enums\PaymentStatus;
use App\Helpers\WorkspaceSuspensionHelper;
use App\UserInvoice;
use App\Workspace;
use DateTime;
use Illuminate\Console\Command;

class SuspendPastDueWorkspacesCommand extends Command
{
    protected $signature = 'billing:suspend-past-due-workspaces {--workspace_id=}';

    protected $description = 'Suspend workspaces with unpaid invoices beyond their grace period';

    public function handle()
    {
        $today = new DateTime('today');
        $workspaceId = $this->option('workspace_id');

        $query = UserInvoice::whereNotNull('due_date')
            ->whereNotIn('status', array(
                PaymentStatus::PAID,
                PaymentStatus::REFUNDED,
                PaymentStatus::CANCELLED,
                'COMPLETE',
                'REFUNDED',
                'CANCELLED',
            ));

        if (!empty($workspaceId)) {
            $query->where('workspace_id', $workspaceId);
        }

        $invoices = $query->orderBy('due_date', 'asc')->get();
        $suspended = 0;

        foreach ($invoices as $invoice) {
            if (empty($invoice->workspace_id) || empty($invoice->due_date)) {
                continue;
            }

            $dueDate = $invoice->due_date instanceof \DateTimeInterface
                ? new DateTime($invoice->due_date->format('Y-m-d'))
                : new DateTime((string) $invoice->due_date);

            if ($dueDate >= $today) {
                continue;
            }

            $daysPastDue = (int) $dueDate->diff($today)->days;
            $threshold = WorkspaceSuspensionHelper::getGracePeriodThresholdForWorkspace($invoice->workspace_id);

            if ($daysPastDue <= $threshold) {
                continue;
            }

            $workspace = Workspace::find($invoice->workspace_id);
            if (!$workspace) {
                continue;
            }

            WorkspaceSuspensionHelper::suspendWorkspace($workspace, $invoice, $daysPastDue, $threshold);
            $suspended++;

            $this->info(sprintf(
                'Suspended workspace #%d: invoice #%d is %d days past due, threshold is %d days.',
                $workspace->id,
                $invoice->id,
                $daysPastDue,
                $threshold
            ));
        }

        $this->info(sprintf('Done. Suspended %d workspace(s).', $suspended));
    }
}
