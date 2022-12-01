<?php

use App\Helpers\RegionDataHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPProvider;
use App\NumberService\ThirdParty\VoIPMSNumberService;

$instance = new VoIPMSNumberService();
$provider1 = SIPProvider::where('name', 'VoIPms')->firstOrFail();


$canada = SIPCountry::create([
      'name' => 'Canada',
      'iso' => 'CA'
]);

$provinces = [
    [
        'name' => 'Alberta',
        'iso' => 'AB'
    ],
[
        'name' => 'Ontario',
        'iso' => 'ON'
    ],
[
        'name' => 'British Columbia',
        'iso' => 'BC'
    ],
[
        'name' => 'Manitoba',
        'iso' => 'MB'
    ],
[
        'name' => 'Quebec',
        'iso' => 'QC'
    ],
    [
        'name' => 'Nova Scotia',
        'iso' => 'NS'
    ]
];
foreach ($provinces as $province) {
  $item = [];
  $item['rate_centers'] = [];
  echo "Loading Canada data for ". $province['iso']. PHP_EOL;
  try {
    $region = SIPRegion::create([
        'country_id' => $canada->id,
        'name' => $province['name'],
        'code' => $province['iso']
      ]);
    $centers = $instance->clazz->getRateCentersCAN($province['iso']);
    if ($centers['status'] == 'success') {
      foreach ( $centers['ratecenters'] as $center ) {
            $attrs = [
              'name' => $center['ratecenter'],
              'region_id' => $region->id,
              'active' => FALSE
            ];
          if ($center['available']== 'yes') {
            $attrs['active'] = TRUE;
          }
            $rCenter = SIPRateCenter::create($attrs);
          SIPRateCenterProvider::create([
              'provider_id' => $provider1->id,
              'center_id' => $rCenter->id
          ]);
      }
    } else {
      echo "Could not get data for ". $province['iso']. PHP_EOL;
    }
  } catch (Exception $ex) {
      echo "Error occured (not critical): " . $ex->getMessage().PHP_EOL;
  }
}


$us = SIPCountry::create([
      'name' => 'United States',
      'iso' => 'US'
    ]);
$states = [
  [
    'iso' => 'CA',
    'name' => 'California'
  ],
  [
    'iso' => 'FL',
    'name' => 'Florida'
  ],
  [
      'iso' => 'NY', 
      'name' => 'New York'
  ],
  [
      'iso' => 'NC', 
      'name' => 'North Carolina'
    ],
    [

        'iso' => 'SC', 
        'name' => 'South Carolina'
    ],
      [

        'iso' => 'TX',
        'name' => 'Texas'
      ],
      [
        'iso' =>  'WA',
        'name' => 'Washington'
    ],
    [
        'iso' => 'MS',
        'name' => 'Massachusetts'
    ],
    [
        'iso' => 'IL',
        'name' => 'Illinois'
    ],
    [
        'iso' => 'NV',
          'name' => 'Nevada'
      ],
      /*
      [
        'iso' => 'MC',
        'name' =>  'Michigan'
      ],
      */
      [
        'iso' => 'PA',
        'name' => 'Pennsylvania'
    ],
      [
        'iso' => 'CO',
        'name' => 'Colorado'
    ],
      [
        'iso' => 'MN',
        'name' => 'Minnesota'
      ]
];
foreach ($states as $state) {
  $item = [];
  $item['rate_centers'] = [];
  echo "Loading USA data for ". $state['iso']. PHP_EOL;
  $region = SIPRegion::create([
      'country_id' => $us->id,
      'name' => $state['name'],
      'code' => $state['iso']
    ]);
  $centers = $instance->clazz->getRateCentersUSA($state['iso']);
  if ($centers['status'] == 'success') {
    foreach ( $centers['ratecenters'] as $center ) {
          $attrs = [
            'name' => $center['ratecenter'],
            'region_id' => $region->id,
            'active' => FALSE
          ];
        if ($center['available']== 'yes') {
          $attrs['active'] = TRUE;
        }
          $rCenter = SIPRateCenter::create($attrs);
          SIPRateCenterProvider::create([
            'provider_id' => $provider1->id,
            'center_id' => $rCenter->id
        ]);

    }
  } else {
    echo "Could not get data for ". $state['iso']. PHP_EOL;
  }
}


