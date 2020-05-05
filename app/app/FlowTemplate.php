<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FlowTemplate extends Model {
  protected $dates = ['created_at', 'updated_at'];
  protected $table = "flows_templates";

  protected $guarded  = array();
}
