<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class Conference extends ApiResource {
  protected $dates = ['created_at', 'updated_at', 'started_time', 'ended_tiem'];

  protected $guarded  = array('id');
  public static $apiPrefix = "conf";
}


