<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;

class File extends ApiResource {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "file";
  public function toArray() {
    $array = parent::toArray();
    $array['public_url'] = \Config::get("mediafiles.url").$array['path'];
    //$array['public_url'] = "https://file-examples.com/wp-content/uploads/2017/11/file_example_WAV_1MG.wav";
    return $array;
  }
}


