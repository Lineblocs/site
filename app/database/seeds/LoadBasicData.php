<?php

use Illuminate\Database\Seeder;
use App\Helpers\MainHelper;
use App\SIPRoutingACL;
use App\SIPPoPRegion;
use App\DDoSSetting;

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
        echo "loading Call system data.." .PHP_EOL;
        require_once($dir1."make_csystem_templates.php");
        echo "loading macro data.." .PHP_EOL;
        require_once($dir1."make_macro_templates.php");
        echo "loading SIP providers.." .PHP_EOL;
        require_once($dir2."load_sip_providers.php");

        echo "loading SIP routers data.." .PHP_EOL;
        require_once($dir2."load_sip_routers.php");
        echo "loading System statuses.." .PHP_EOL;
        require_once($dir2."load_system_statuses.php");
        echo "loading call rates.." .PHP_EOL;
        require_once($dir2."load_call_rates.php");




        echo "loading SIP data.." .PHP_EOL;
        require_once($dir2."load_sip_data.php");
        /*
        echo "loading SIP Canada data.." .PHP_EOL;
        require_once($dir2."load_sip_ca_data.php");
        echo "loading SIP United States data.." .PHP_EOL;
        require_once($dir2."load_sip_us_data.php");
        */

        // create some default regions
        SIPPoPRegion::create([
            'name' => 'N Virginia',
            'code' => 'us-east-1'
        ]);
        SIPPoPRegion::create([
            'name' => 'Canada Central',
            'code' => 'ca-central-1'
        ]);
        SIPRoutingACL::create([
            'iso' => 'us',
            'name' => 'United States',
            'risk_level' => 'low',
            'enabled' => TRUE
        ]);
        // load SIP routing ACLs
        $riskLevels = MainHelper::$aclRiskLevels;
        SIPRoutingACL::create([
            'iso' => 'us',
            'name' => 'United States',
            'risk_level' => 'low',
            'enabled' => TRUE
        ]);
        SIPRoutingACL::create([
            'iso' => 'ca',
            'name' => 'Canada',
            'risk_level' => 'low',
            'enabled' => TRUE
        ]);

        DDoSSetting::create([
            'priority_aware_packet_policing' => FALSE,
            'media_packet_policing' => FALSE,
            'media_address_learning' => FALSE,
            'application_level_cac' => FALSE
        ]);
    }
}
