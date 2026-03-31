<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Workspace;
use App\Helpers\RabbitMQHelper;

class QueueMonthlyInvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:queue-monthly {workspace_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue a MONTHLY invoice task for a workspace';

    public function handle()
    {
        $workspaceId = (int) $this->argument('workspace_id');
        $workspace = Workspace::find($workspaceId);
        if (!$workspace) {
            $this->error(sprintf('Workspace #%d not found.', $workspaceId));
            return;
        }

        RabbitMQHelper::dispatchMonthlyInvoiceTask($workspaceId, 'artisan_test');
        $this->info(sprintf('Queued MONTHLY invoice task for workspace #%d.', $workspaceId));
    }
}
