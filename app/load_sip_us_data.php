<<?php
use App\User;
use App\UserDebit;
use App\NumberService\ThirdParty\VoIPMSNumberService;
$country = "US";
$region = "CA";
$prefix = "";
$instance = new VoIPMSNumberService();
function csvResults($array) {

}
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
    ]
];
$map = [];

foreach ($states as $state) {
  $item = [];
  $item['rate_centers'] = [];
  $centers = $instance->clazz->getRateCentersUSA($state['iso']);
  if ($centers['status'] == 'success') {
    foreach ( $centers['ratecenters'] as $center ) {
        if ($center['available']== 'yes') {
        $item['rate_centers'][] = $center['ratecenter'];
        }
    }
  }
  $map[$state['iso']][] = $item;
}
