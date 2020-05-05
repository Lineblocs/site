<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\TagResource;

class ExtensionTag extends TagResource {

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "extensions_tags";
  public static $idField = "extension_id";
}


