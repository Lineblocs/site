<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemStatusUpdate extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "system_status_updates";
  public function showCreatedFriendly() {
    return $this->created_at->format("Y-m-d");
  }
}


