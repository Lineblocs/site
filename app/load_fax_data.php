<?php

use App\Helpers\RegionDataHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPProvider;
$provider1 = SIPProvider::where('name', 'VoIPms')->firstOrFail();
$countries = SIPCountry::all();
$test = new \App\NumberService\ThirdParty\VoIPMSNumberService();
foreach ($countries as $country) {
  if ($country->iso=='CA') {
/*
      $regions = SIPRegion::where('country_id', $country->id)->get();
      foreach ($regions as $region) {
        $faxCenters = $test->clazz->getFaxRateCentersCAN($region['code']);
        foreach ($faxCenters['ratecenters'] as $fCenter) {
            if ($fCenter['available']=='yes') {
              $match = SIPRateCenter::where('name',$fCenter['ratecenter'])->first();
              if ($match) {
                echo "updating rate center: " . $match['name'] . " to include fax.." . PHP_EOL;
                $match->update(['fax_enabled'=>TRUE, 'fax_data_1' => $fCenter['location']]);
              }
            }
          }
      }
*/

  } elseif ($country->iso=='US') {
      $regions = SIPRegion::where('country_id', $country->id)->get();
      foreach ($regions as $region) {
        //echo var_dump($region);
        //$faxCenters = $test->clazz->getFaxRateCentersUSA($region['code']);
        $faxCenters = $test->clazz->getFaxRateCentersUSA('AL');
        if ($faxCenters['status'] != 'invalid_state') {
        foreach ($faxCenters['ratecenters'] as $fCenter) {
            if ($fCenter['available']=='yes') {
              $match = SIPRateCenter::where('name',$fCenter['ratecenter'])->first();
              if ($match) {
                echo "updating rate center: " . $match['name'] . " to include fax.." . PHP_EOL;
                $match->update(['fax_enabled'=>TRUE, 'fax_data_1' => $fCenter['location']]);
              }
            }
          }
        }
      }

  }

}
