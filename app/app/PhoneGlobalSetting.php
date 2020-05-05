<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;

class PhoneGlobalSetting extends PublicResource {
  public static $publicPrefix = "pgs";

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "phones_global_settings";
}


