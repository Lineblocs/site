<?php

use App\Helpers\RegionDataHelper;
use App\CallRate;
use App\CallRateDialPrefix;
        // outbound rates
        $rate = CallRate::create([
            'name' => 'United States & Canada Outbound',
            'type' => 'outbound',
            'call_rate' => '0.01300'
        ]);
        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate->id,
            'dial_prefix' => '1'
        ]);
        $rate2 = CallRate::create([
            'name' => 'United States & Canada Outbound - Toll Free',
            'type' => 'outbound',
            'call_rate' => '0.0085'
        ]);

        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1800'
        ]);
        $prefix2 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1833'
        ]);
        $prefix3 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1844'
        ]);
        $prefix4 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1855'
        ]);
        $prefix5 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1866'
        ]);
        $prefix6 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1877'
        ]);
        $prefix7 = CallRateDialPrefix::create([
            'call_rate_id' => $rate2->id,
            'dial_prefix' => '1888'
        ]);

        $rate3 = CallRate::create([
            'name' => 'United States - Alaska Outbound',
            'type' => 'outbound',
            'call_rate' => '0.09000'
        ]);

        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate3->id,
            'dial_prefix' => '1907'
        ]);

        $rate4 = CallRate::create([
            'name' => 'United States - Hawaii Outbound',
            'type' => 'outbound',
            'call_rate' => '0.130000',
        ]);

        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate4->id,
            'dial_prefix' => '1808'
        ]);


         $rate5 = CallRate::create([
            'name' => 'Canada - Yukon Territory Outbound',
            'type' => 'outbound',
            'call_rate' => '0.145000',
        ]);

        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate5->id,
            'dial_prefix' => '1867'
        ]);




        $rate = CallRate::create([
            'name' => 'United States Inbound',
            'type' => 'inbound',
            'call_rate' => '0.00085'
        ]);
        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate->id,
            'dial_prefix' => '1'
        ]);
        $rate = CallRate::create([
            'name' => 'Canada Inbound',
            'type' => 'inbound',
            'call_rate' => '0.00085'
        ]);
        $prefix1 = CallRateDialPrefix::create([
            'call_rate_id' => $rate->id,
            'dial_prefix' => '1'
        ]);
