<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MonthlyBillCommand;
use App\Console\Commands\SendBackgroundEmails;
use App\Console\Commands\RemoveOldLogs;
use App\Console\Commands\FreeTrialEndingCommand;
use App\Console\Commands\DeleteUnsetPasswordUsers;
use App\Console\Commands\RabbitMQEventConsumer;
use App\Console\Commands\SendWorkspaceInvoicesCommand;
use App\Console\Commands\QueueMonthlyInvoiceCommand;
use App\Console\Commands\QueueAnnualInvoiceCommand;
use App\Console\Commands\SendMonthlyWorkspaceInvoiceCommand;
use App\Console\Commands\SendAnnualWorkspaceInvoiceCommand;
use App\Console\Commands\SendEmailTemplatePreviewsCommand;
// use App\Console\Commands\SuspendPastDueWorkspacesCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        MonthlyBillCommand::class,
        SendBackgroundEmails::class,
        FreeTrialEndingCommand::class,
        RemoveOldLogs::class,
        DeleteUnsetPasswordUsers::class,
        RabbitMQEventConsumer::class,
        SendWorkspaceInvoicesCommand::class,
        QueueMonthlyInvoiceCommand::class,
        QueueAnnualInvoiceCommand::class,
        SendMonthlyWorkspaceInvoiceCommand::class,
        SendAnnualWorkspaceInvoiceCommand::class,
        SendEmailTemplatePreviewsCommand::class,
        // SuspendPastDueWorkspacesCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
            ->hourly();
    }
}
