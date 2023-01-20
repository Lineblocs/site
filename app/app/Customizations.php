<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;

class Customizations extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table ='customizations';
  protected $casts = array(
    "payment_gateway_enabled" => "boolean",
    "custom_code_containers_enabled" => "boolean"
  );
  public static function getRecord() {
    return Customizations::all()[0];
  }
  public function toArray() {
    $result = parent::toArray();
    $result['app_logo'] = url('assets/img/' . $result['app_logo']);
    $result['alt_app_logo'] = url('assets/img/' . $result['alt_app_logo']);
    $result['app_icon'] = url('assets/img/' . $result['app_icon']);
    $result['admin_portal_logo'] = url('assets/img/' . $result['admin_portal_logo']);
    return $result;
  }
}


