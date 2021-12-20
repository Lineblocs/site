<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class RouterFlowTemplate extends Model {
  protected $dates = ['created_at', 'updated_at'];
  protected $table = "router_flows_templates";

  protected $guarded  = array();
}
