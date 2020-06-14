<?php

use Illuminate\Database\Seeder;
use DB;

class LoadPhoneData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::unprepared(base_path('sql-backups/phone-defs-grandstreams'));
        require_once(base_path('phones_defaults_cisco.php'));
        require_once(base_path('phones_defaults_polycomIP330.php'));
    }
}
