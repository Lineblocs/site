<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkspaceRegion extends PublicResource {
  protected $dates = ['created_at', 'updated_at'];
  public static $publicPrefix = "wr";
  protected $guarded  = array('id');
  protected $table = "workspaces_regions";
  protected $casts = [
  ];

}


