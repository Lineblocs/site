<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MonthlyBillCommand;
use App\Console\Commands\SendBackgroundEmails;
use App\Console\Commands\RemoveOldLogs;
use App\Console\Commands\FreeTrialEndingCommand;
use App\Console\Commands\DeleteUnsetPasswordUsers;

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
        DeleteUnsetPasswordUsers::class
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
