<?php

use Illuminate\Database\Seeder;
use App\Flow;
use App\User;

class FlowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $abs = base_path("/sql-backups/flows_templates.sql");
        $contents = file_get_contents($abs);
        \DB::unprepared($contents);

    }
}
