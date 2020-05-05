<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extension extends PublicResource {
  public static $publicPrefix = "ext";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


