<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class DebuggerLog extends ApiResource {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "log";
}


