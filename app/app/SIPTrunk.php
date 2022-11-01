<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SIPTrunk extends PublicResource {
  public static $publicPrefix = "st";
  protected $casts = array(
    "record" => "boolean"
  );
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "sip_trunks";
}


