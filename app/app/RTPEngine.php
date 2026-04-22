<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RTPEngine extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $casts = array(
    'on_same_network_as_router' => 'boolean'
  );
  protected $table  = "rtpengine";
  public static function asSelect() {
    $list = [];
    $items = self::all();
    foreach ( $items as $item ) {
      $list[ $item->id ] = $item->socket;
    }
    return $list;
  }
}


