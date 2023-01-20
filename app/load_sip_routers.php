<?php

use App\Helpers\RegionDataHelper;
use App\SIPCountry;
use App\SIPRegion;
use App\SIPRateCenter;
use App\SIPRateCenterProvider;
use App\SIPRouter;
use App\SIPRouterMediaServer;
use App\MediaServer;
$router1 = SIPRouter::create([
  'name' => 'Canada PoP',
  'ip_address' => '0.0.0.0',
  'ip_address_range' => '/32',
  'private_ip_address' => '127.0.0.1',
  'ip_address_range' => '/32',
  'active' => TRUE,
  'region' => 'ca-central-1'
]);