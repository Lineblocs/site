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

final class WhatsAppHelper {
  public static function sendMessage($from='', $to='', $body='') {
    $customizations = CustomizationsKVStore::getRecord();

  }
}
