<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BYOCarrier extends PublicResource {
  public static $publicPrefix = "d";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "byo_carriers";
}


