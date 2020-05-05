<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerifiedCallerId extends PublicResource {
  public static $publicPrefix = "vci";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "verified_callerids";
}


