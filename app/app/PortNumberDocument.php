<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Config;

class PortNumberDocument extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "port_numbers_documents";
  public function toArray() {
     $array = parent::toArray();
     $array['url'] = Config::get("app.url")."/documents/".$this->filename;
      return $array;
  }
}


