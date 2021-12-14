<?php

use Illuminate\Database\Seeder;
use App\ApiCredential;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ApiCredential::create();
    }
}
