<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\TagResource;

class PhoneTag extends TagResource {

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "phones_tags";
  public static $idField = "phone_id";
}


