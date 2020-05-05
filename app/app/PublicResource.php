<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;

class PublicResource extends Model {
  public static function create($attrs=array()) {
    $attrs['public_id'] = MainHelper::createApiId(static::$publicPrefix);
    return parent::create( $attrs );
  }

}


