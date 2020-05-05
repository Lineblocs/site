<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class Fax extends ApiResource {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "fax";
  public function toArray() {
    $array = parent::toArray();
    $array['public_url'] = \Config::get("app.url")."/fs/faxes/".$array['name'];
    return $array;
  }
}


