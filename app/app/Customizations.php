<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use DB;
use Schema;

class Customizations extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table ='customizations';
  protected $casts = array(
    "payment_gateway_enabled" => "boolean",
    "custom_code_containers_enabled" => "boolean",
    "registration_questionnaire_enabled" => "boolean",
    "enable_google_signin" => "boolean",
    "enable_msft_signin" => "boolean",
    "enable_apple_signin" => "boolean",
    "signup_requires_payment_detail" => "boolean",
    "billing_retry_enabled" => "boolean",
    "zendesk_enabled" => "boolean",
    "show_savings_content" => "boolean",
  );
  public static function getRecord($additionalColumns=false) {
    $all_columns = Customizations::getColumns();
    $exclude_columns = [];
    if (!$additionalColumns) {
      $exclude_columns[] = 'opensips_config';
    }
    $get_columns = array_diff($all_columns, $exclude_columns);

    return Customizations::select($get_columns)->first();
  }
  public function toArray() {
    $result = parent::toArray();
    $result['app_logo'] = url('assets/img/' . $result['app_logo']);
    $result['alt_app_logo'] = url('assets/img/' . $result['alt_app_logo']);
    $result['app_icon'] = url('assets/img/' . $result['app_icon']);
    $result['admin_portal_logo'] = url('assets/img/' . $result['admin_portal_logo']);
    return $result;
  }
  public static function getColumns() {
    $db = DB::connection()->getPdo();
    $rs = $db->query('SELECT * FROM customizations LIMIT 0');
    for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = $col['name'];
    }
    //print_r($columns);
    return $columns;
  }
}


