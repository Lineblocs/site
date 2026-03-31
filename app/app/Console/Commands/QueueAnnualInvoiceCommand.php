<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Workspace;
use App\Helpers\RabbitMQHelper;

class QueueAnnualInvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:queue-annual {workspace_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue an ANNUAL invoice task for a workspace';

    public function handle()
    {
        $workspaceId = (int) $this->argument('workspace_id');
        $workspace = Workspace::find($workspaceId);
        if (!$workspace) {
            $this->error(sprintf('Workspace #%d not found.', $workspaceId));
            return;
        }

        RabbitMQHelper::dispatchAnnualInvoiceTask($workspaceId, 'artisan_test');
        $this->info(sprintf('Queued ANNUAL invoice task for workspace #%d.', $workspaceId));
    }
}
