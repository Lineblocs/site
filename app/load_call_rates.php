<?php

use App\Helpers\RegionDataHelper;
use App\CallRate;
use App\CallRateDialPrefix;

$us = [
"403",
"205",
"256",
"334",
"251",
"870",
"501",
"479",
"480",
"623",
"928",
"602",
"520",
"628",
"341",
"764",
"925",
"909",
"562",
"661",
"657",
"510",
"650",
"949",
"760",
"415",
"951",
"752",
"831",
"209",
"669",
"408",
"559",
"626",
"442",
"530",
"916",
"707",
"627",
"714",
"310",
"323",
"213",
"424",
"747",
"818",
"858",
"935",
"619",
"805",
"369",
"720",
"303",
"970",
"719",
"203",
"959",
"475",
"860",
"202",
"302",
"689",
"407",
"239",
"836",
"727",
"321",
"754",
"954",
"352",
"863",
"904",
"386",
"561",
"772",
"786",
"305",
"861",
"941",
"813",
"850",
"478",
"770",
"470",
"404",
"706",
"678",
"912",
"229",
"671",
"515",
"319",
"563",
"641",
"712",
"208",
"217",
"282",
"872",
"312",
"773",
"464",
"708",
"815",
"224",
"847",
"618",
"309",
"331",
"630",
"765",
"574",
"260",
"219",
"317",
"812",
"913",
"785",
"316",
"620",
"327",
"502",
"859",
"606",
"270",
"504",
"985",
"225",
"318",
"337",
"774",
"508",
"781",
"339",
"857",
"617",
"978",
"351",
"413",
"443",
"410",
"280",
"249",
"969",
"240",
"301",
"207",
"383",
"517",
"546",
"810",
"278",
"313",
"586",
"248",
"734",
"269",
"906",
"989",
"616",
"231",
"679",
"947",
"612",
"320",
"651",
"763",
"952",
"218",
"507",
"636",
"660",
"975",
"816",
"314",
"557",
"573",
"417",
"670",
"601",
"662",
"228",
"406",
"336",
"252",
"984",
"919",
"980",
"910",
"828",
"704",
"701",
"402",
"308",
"603",
"908",
"848",
"732",
"551",
"201",
"862",
"973",
"609",
"856",
"505",
"957",
"702",
"775",
"315",
"518",
"716",
"585",
"646",
"347",
"718",
"212",
"516",
"917",
"845",
"631",
"607",
"914",
"216",
"330",
"234",
"567",
"419",
"380",
"440",
"740",
"614",
"283",
"513",
"937",
"918",
"580",
"405",
"503",
"971",
"541",
"814",
"717",
"570",
"358",
"878",
"835",
"484",
"610",
"445",
"267",
"215",
"724",
"412",
"939",
"787",
"401",
"843",
"864",
"803",
"605",
"423",
"865",
"931",
"615",
"901",
"731",
"254",
"325",
"713",
"940",
"817",
"430",
"903",
"806",
"737",
"512",
"361",
"210",
"936",
"409",
"979",
"972",
"469",
"214",
"682",
"832",
"281",
"830",
"956",
"432",
"915",
"435",
"801",
"385",
"434",
"804",
"757",
"703",
"571",
"540",
"276",
"381",
"236",
"802",
"509",
"360",
"564",
"206",
"425",
"253",
"715",
"920",
"414",
"262",
"608",
"353",
"420",
"304",
"307"
];

        // outbound rates
        $rate = CallRate::create([
            'name' => 'United States Outbound',
            'type' => 'outbound',
            'call_rate' => '0.01300'
        ]);

        foreach ($us as $code) {
            $prefix1 = CallRateDialPrefix::create([
                'call_rate_id' => $rate->id,
                'dial_prefix' => "1".$code
            ]);
        }
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

            $ca = [
                // Alberta
"368", "403", "587", "780", "825",
// BC
"236", "250", "604", "672", "778",
// Manitoba
"204", "431",
// New Brunswick
"428", "506",
// New Foundland
"709", "879",
// NWT
"867",
// Nova Scotia
"782", "902",
// Nunavut
"867",
// Ontario
"226", "249", "289", "343", "365", "416", "437", "519", "548", "613", "647", "705", "807", "905",
// PEI
"782", "902",
// Quebec
"354", "367", "418", "438", "450", "514", "579", "581", "819", "873",
// Sask
"306", "474", "639",
// Yukon
//"867",
// Non geographic
"600", "622"

            ];
       // outbound rates
        $rate = CallRate::create([
            'name' => 'Canada Outbound',
            'type' => 'outbound',
            'call_rate' => '0.01300'
        ]);

        foreach ($ca as $code) {
            $prefix1 = CallRateDialPrefix::create([
                'call_rate_id' => $rate->id,
                'dial_prefix' => "1".$code
            ]);
        }
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
