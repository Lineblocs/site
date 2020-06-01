<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DebuggerLog;
use DB;
use Carbon\Carbon;

class RemoveOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debuggerlogs:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old debugger logs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
      $date = new \DateTime();
      printf("Starting cron at %s\r\n", $date->format("Y-m-d H:i:s"));
        $daysToRetain1 = 7;
        $logs = DB::table('debugger_logs')->where('created_at', '<=', Carbon::now()->subDays($daysToRetain1)->toDateTimeString())->delete();
        $daysToRetain2 = 7;
        $logs = DB::table('error_user_trace')->where('created_at', '<=', Carbon::now()->subDays($daysToRetain2)->toDateTimeString())->delete();
    }
}
