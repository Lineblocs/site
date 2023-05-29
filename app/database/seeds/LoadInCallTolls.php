<?php

use Illuminate\Database\Seeder;
use App\CallOutboundRegistry;
use App\CallOutboundRegistryPrefix;
use App\CallInboundRegistry;

class LoadInCallTolls extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CallOutboundRegistry::create([
            'iso' => 'US',
            'description' => 'North America'
        ])
    }
}
