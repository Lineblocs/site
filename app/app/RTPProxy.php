<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RTPProxy extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "rtpproxy_sockets";
  public static function asSelect() {
    $list = [];
    $items = self::all();
    foreach ( $items as $item ) {
      $list[ $item->id ] = $item->rtpproxy_sock;
    }
    return $list;
  }
}


