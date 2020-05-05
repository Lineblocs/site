<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;

class PhoneIndividualSetting extends PublicResource {
  public static $publicPrefix = "pis";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "phones_individual_settings";
}


