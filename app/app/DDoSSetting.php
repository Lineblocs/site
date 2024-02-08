<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DDoSSetting extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "ddos_settings";
  protected $casts = array(
    "priority_aware_packet_policing" => "boolean",
    "media_packet_policing" => "boolean",
    "media_address_learning" => "boolean",
    "application_level_cac" => "boolean",
  );

  public static function getRecord() {
    return DDoSSetting::all()[0];
  }
}


