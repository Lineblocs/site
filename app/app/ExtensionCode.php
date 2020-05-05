<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;

class ExtensionCode extends PublicResource {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $publicPrefix = "ec";
  protected $table = "extension_codes";
}


