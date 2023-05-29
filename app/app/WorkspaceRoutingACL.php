<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WorkspaceRoutingACL extends Model {

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $casts = array(
    "enabled" => "boolean"
  );
  protected $table = "workspace_routing_acl";
}


