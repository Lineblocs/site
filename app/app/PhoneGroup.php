<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;
class PhoneGroup extends PublicResource {
  public static $publicPrefix = "pg";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "phones_groups";
}


