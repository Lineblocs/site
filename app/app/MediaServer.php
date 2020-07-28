<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaServer extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "media_servers";
  protected $casts = array(
    "webrtc_optimized" => "boolean"
  );
  public static function asSelect() {
    $all = self::all();
    $results = [];
    foreach ($all as $item) {
      $results[ $item->id ] = $item->name;
    }
    return $results;
  }
}


