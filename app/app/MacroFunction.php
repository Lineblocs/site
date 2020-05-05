<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MacroFunction extends PublicResource {
  public static $publicPrefix = "mf";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


