<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Workspace;
use App\Helpers\WorkspaceInvoiceHelper;

class SendAnnualWorkspaceInvoiceCommand extends Command
{
    protected $signature = 'invoices:send-annual {--workspace_id=} {--email=}';
    protected $description = 'Send ANNUAL invoice email(s) to workspace owner(s)';

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
                $result = WorkspaceInvoiceHelper::sendInvoiceForWorkspace($workspace, 'ANNUAL');
                $this->info(sprintf(
                    'Sent ANNUAL invoice to %s (workspace #%d, invoice %s).',
                    $result['email'],
                    $result['workspace_id'],
                    $result['invoice_no']
                ));
                $sent++;
            } catch (\Exception $ex) {
                $this->error(sprintf('Failed workspace #%d: %s', $workspace->id, $ex->getMessage()));
            }
        }

        $this->info(sprintf('Done. Sent %d annual invoice email(s).', $sent));
    }

    private function getTargetWorkspaces()
    {
        $query = Workspace::query();
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
