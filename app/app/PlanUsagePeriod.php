<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanUsagePeriod extends Model {
  protected $dates = ['created_at', 'updated_at', 'started_at', 'renews_at', 'ended_at'];

  protected $guarded  = array('id');
  protected $table = "plan_usage_period";
}


