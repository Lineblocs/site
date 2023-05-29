<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WorkspaceEventProperty extends Model {

  protected $dates = ['created_at', 'updated_at', 'expires_on'];

  protected $guarded  = array('id');
  protected $table = "workspaces_events_properties";
}


