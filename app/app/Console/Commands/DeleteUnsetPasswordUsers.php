<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class DeleteUnsetPasswordUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanups:delete-unset-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete users who have not setup their passwords';

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
        $daysCheck = "7";
        $users = User::whereRaw("needs_set_password_date <= DATE_ADD(NOW(), INTERVAL -$daysCheck DAY)")
                    ->where('needs_password_set', '1')
                    ->get();
        foreach ($users as $user) {
            $user->delete();
        }

    }
}
