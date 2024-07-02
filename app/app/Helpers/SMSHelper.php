<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;
use App\Customizations;
use App\CustomizationsKVStore;
use \HaydenPierce\ClassFinder\ClassFinder;
use Exception;
use Log;

final class SMSHelper {
  public static function sendSMS($from='', $to='', $body='') {
    $customizations = CustomizationsKVStore::getRecord();
    $ignoredClasses = ['App\Helpers\Sms\Base'];
    ClassFinder::disablePSR4Vendors(); // Optional; see performance notes below
    $providers = array_filter( ClassFinder::getClassesInNamespace('App\Helpers\Sms'), function($provider) use ($ignoredClasses) {
      if ( in_array( $provider, $ignoredClasses )) {
        return FALSE;
      }
      return TRUE;
    });
    $smsProvider = NULL;
    foreach ( $providers as $provider ) {
      $name = $provider::getProviderName();
      if ( $name == $customizations->sms_provider ) {
        $smsProvider = $provider;
        break;
      }
    }
    if (empty($smsProvider)) {
      // no provider implementation found
      Log::error("no sms provider implementation for: " . $customizations->sms_provider);
      return;
    }
    try {
      $providerObj = new $smsProvider();
      $providerObj->sendSMS($from, $to, $body);
    } catch ( Exception $ex ) {
      Log::error("error sending SMS message: " . $ex->getMessage());
    }
  }
}
