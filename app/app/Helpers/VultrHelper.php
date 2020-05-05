<?php

namespace App\Helpers;
use Config;
use LinkORB\Vultr\Vultr;
use Log;
final class VultrHelper {
  public static function listRegions() {
    $vultr = Config::get("vultr"); 
    $vultrApi = new Vultr($vultr['api_key']);

    $api = $vultrApi->regionApi() ;
    $res = $api->getList() ;
    echo var_dump($res) ;
  }
  public static function reserveIP($mainIp) {
    $vultr = Config::get("vultr"); 
    $vultrApi = new Vultr($vultr['api_key']);
    $toronto = $vultr['toronto_dcid'];
    $api = $vultrApi->reservedIpApi() ;
    $reply = $api->create($toronto, 'v4');
    if (!$reply) {
      return FALSE;
    }
    $sub = $reply['SUBID'];
    Log::info("attaching SUBID: " . $sub . " to IP: " .$mainIp);
    $reply = $api->attach($sub, $mainIp);
    if (!$reply) {
      return FALSE;
    }
    $reply = $api->getList();
    if (!$reply) {
      return FALSE;
    }

    foreach ($reply as $item) {
      if ($item['SUBID'] == $sub) {
        return $item['subnet'];
      }
    }
    return TRUE;
  }
}

