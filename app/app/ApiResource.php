<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;

class ApiResource extends Model {
  public static function create($attrs=array()) {
    $attrs['api_id'] = MainHelper::createApiId(static::$apiPrefix);
    return parent::create( $attrs );
  }

}


