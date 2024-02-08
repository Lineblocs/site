<?php
namespace App\Helpers;
use \Config;
use \DateTime;
use App\Settings;
use App\Customizations;
use \HaydenPierce\ClassFinder\ClassFinder;
use Exception;
use Log;

final class WhatsAppHelper {
  public static function sendMessage($from='', $to='', $body='') {
    $customizations = Customizations::getRecord();

  }
}
