<?php

use App\Helpers\RegionDataHelper;
use App\SystemStatusCategory;
use App\CallRateDialPrefix;
        // outbound rates
        $cat1= SystemStatusCategory::create([
            'name' => 'DID API availability'
        ]);
        $cat2= SystemStatusCategory::create([
            'name' => 'Partner SIP Trunking Networks'
        ]);
        $cat3= SystemStatusCategory::create([
            'name' => 'Media Storage Uptime'
        ]);
        $cat4= SystemStatusCategory::create([
            'name' => 'PoP uptime'
        ]);



