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
  'ip_address' => '52.60.126.237',
  'ip_address_range' => '/32',
  'private_ip_address' => '172.31.21.3',
  'ip_address_range' => '/32',
  'active' => TRUE,
  'region' => 'ca-central-1'
]);
$server1 = MediaServer::create([
  'name' => 'Canada PBX 1',,
  'ip_address' => '35.183.88.150',
  'ip_address_range' => '/32',
  'private_ip_address' => '172.31.18.26',
  'ip_address_range' => '/32',
  'active' => TRUE
]);
SIPRouterMediaServer::create([
  'router_id' => $router1->id,
  'server_id' => $server1->id,
]);
