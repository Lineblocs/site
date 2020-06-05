<?php

use App\Helpers\RegionDataHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPProvider;
use App\SIPProviderHost;
use App\SIPProviderWhitelistIp;
$provider1 = SIPProvider::create([
  'name' => 'VoIPMS',
  'api_name' => 'VoIPMS',
  'host' => 'toronto.voip.ms',
  'type_of_provider' => 'both'
]);
SIPProviderHost::create([
  'provider_id' => $provider1->id,
  'name' => 'Toronto',
  'ip_address' => 'toronto.voip.ms',
  'ip_address' => 'toronto.voip.ms',
  'priority' => '1'
]);
SIPProviderWhitelistIp::create([
  'provider_id' => $provider1->id,
  'ip_address' => '158.85.70.148',
  'range' => '/32'
]);
