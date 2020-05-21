<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class Recording extends ApiResource {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "recording";
  public function toArray() {
    $array = parent::toArray();
    if (!empty($array['name'])) {
      $array['public_url'] = \Config::get("app.url")."/fs/recording/".$array['name'];
    }
    //$array['public_url'] = "https://file-examples.com/wp-content/uploads/2017/11/file_example_WAV_1MG.wav";
    return $array;
  }
}


