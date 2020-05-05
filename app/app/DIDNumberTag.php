<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\TagResource;

class DIDNumberTag extends TagResource {

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "did_numbers_tags";
  public static $idField = "number_id";
}


