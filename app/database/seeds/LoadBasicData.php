<?php

use Illuminate\Database\Seeder;

class LoadBasicData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dir1 = __DIR__."/../../data/";
        $dir2 = __DIR__."/../../";
        require_once($dir1."make_csystem_templates.php");
        require_once($dir1."make_macro_templates.php");
        require_once($dir1."make_macro_templates.php");

        require_once($dir2."load_sip_providers.php");
        require_once($dir2."load_sip_ca_data.php");
        require_once($dir2."load_sip_us_data.php");
        require_once($dir2."load_sip_countries.php");
        require_once($dir2."load_sip_routers.php");
        require_once($dir2."load_system_statuses.php");

    }
}
