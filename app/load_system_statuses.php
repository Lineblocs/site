<?php

use App\Helpers\RegionDataHelper;
use App\SystemStatusCategory;
use App\CallRateDialPrefix;
        // outbound rates
        $cat1= SystemStatusCategory::create([
            'name' => 'SIP Trunking Networks'
        ]);
        $cat2= SystemStatusCategory::create([
            'name' => 'Media Storage Servers'
        ]);
        $cat3= SystemStatusCategory::create([
            'name' => 'PoP Servers'
        ]);
        $cat4= SystemStatusCategory::create([
            'name' => 'User Portals'
        ]);




