<?php

use Illuminate\Database\Seeder;
use App\CallRate;
use App\CallRateDialPrefix;

class AddCallRates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require("../../load_call_rates.php");
    }
}
