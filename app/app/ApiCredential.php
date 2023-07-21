<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use Exception;
use Log;

class ApiCredential extends Model {
  protected $dates = ['created_at', 'updated_at'];
  protected $casts = array(
    "setup_complete" => "boolean"
  );

  protected $guarded  = array('id');
  public static function getRecord() {
    return ApiCredential::all()[0];
  }

  public static function getParameterIfAvailable($param) {
    try {
      $record = self::getRecord();
      return $record->{$param};
    } catch (Exception $ex) {
      print("error occured while getting API credential: " .$param);
    }
    return "";
  }
  public static function getFrontendValuesOnly() {
    extract( self::getRecord()->toArray() );
    return compact(
'google_signin_developer_key',
'google_signin_client_id',
'google_signin_app_id',
'msft_signin_client_id',
'msft_signin_client_secret',
'apple_signin_client_id',
'apple_signin_client_secret',
'google_analytics_script_tag',
'matomo_script_tag',
'stripe_pub_key'
    );
  }

}


