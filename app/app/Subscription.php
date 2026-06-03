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

  public function toArray()
  {
    $array = parent::toArray();
    if (!empty($this->scheduled_plan_id)) {
      $array['effective_plan_id'] = $this->scheduled_plan_id;
    } else {
      $array['effective_plan_id'] = $this->current_plan_id;
    }
    return $array;
  }
}


