<?php

use App\Helpers\RegionDataHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPProvider;
$provider1 = SIPProvider::where('name', 'VoIPMS')->firstOrFail();
foreach (RegionDataHelper::$areas as $iso =>  $area) {
    $country = SIPCountry::create([
        'iso' => $iso,
        'name' => $area['name']
    ]);
    foreach ($area['regions'] as $code => $regionArea) {
      $region = SIPregion::create([
        'code' => $code,
        'name' =>  $regionArea['name'],
        'country_id' => $country->id
      ]);

      foreach ($regionArea['rate_centers'] as $item) {
        $center = SIPRateCenter::create([
          'name' => $item,
          'region_id' => $region->id
        ]);
        SIPRateCenterProvider::create([
          'center_id' => $center->id,
          'provider_id' => $provider1->id
        ]);

      }
    }


}
