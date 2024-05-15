<?php
namespace App\Helpers;
use App\Customizations;
use Config;
use Auth;
use DB;

final class CustomizationsHelper {

    public static $customizations = NULL;

  public static function get($key='') {
    $customizations = self::$customizations;

    if (is_null(self::$customizations)) {
        $customizations = Customizations::getRecord();
        self::$customizations = $customizations;
    }
    
    return $customizations[$key];
  }
}
