<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MacroTemplate extends PublicResource {
  public static $publicPrefix = "mt";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


