<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkspaceParam extends Model {
  public static $publicPrefix = "wp";
  protected $table = "workspace_params";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


