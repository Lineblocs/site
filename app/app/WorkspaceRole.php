<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkspaceRole extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "workspaces_roles";

  public static function getDefaultRole() {
    return self::where('key', '=', 'VIEWER')->firstOrFail();
  }
}


