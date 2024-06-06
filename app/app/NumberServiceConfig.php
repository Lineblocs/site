<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberServiceConfig extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "number_services_config";
  protected $casts = array(
  );

  public static function getValues($serviceId) {
    $records = self::where('number_service_id', $serviceId)->get();
    $result = [];
    foreach ($records as $record) {
      $result[$record['param']] = $record['value'];
    }

    return $result;
  }

}


