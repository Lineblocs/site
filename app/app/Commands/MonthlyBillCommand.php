<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
namespace App\Console\Commands;

use Illuminate\Console\Command;

class HealthcheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'healthcheck
                            {url : The URL to check}
                            {status=200 : The expected status code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs an HTTP healthcheck to verify the endpoint is available';

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
    }
}
