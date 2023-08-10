<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;

final class SMSHelper {
  public static function sendSMS($from='', $to='', $body='') {
    $customizations = Customizations::getRecord();
    ClassFinder::disablePSR4Vendors(); // Optional; see performance notes below
    $providers = ClassFinder::getClassesInNamespace('App\Helpers\Sms');
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
    $providerObj = new $smsProvider();
    $providerObj->sendSMS($from, $to, $body);
  }
}
