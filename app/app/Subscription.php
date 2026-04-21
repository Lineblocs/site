<?php

namespace App;

use App\Helpers\MainHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\ServicePlan;
use App\WorkspaceUser;

class Subscription extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "subscriptions";
  protected $casts = array(
  );
}


