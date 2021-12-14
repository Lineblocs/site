<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;

class ApiCredential extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static function getRecord() {
    return ApiCredential::all()[0];
  }

}


