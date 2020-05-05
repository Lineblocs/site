<?php

use Illuminate\Database\Seeder;

class AddSystemStatusData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        require("../../load_system_statuses.php");
    }
}
