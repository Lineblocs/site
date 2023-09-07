<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SIPRouter extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $casts  = array(
    'default' => 'boolean'
  );
  protected $table  = "sip_routers";
  public static function asSelect() {
    $list = [];
    $items = self::all();
    foreach ( $items as $item ) {
      $list[ $item->id ] = $item->name;
    }
    return $list;
  }
  public static function getMainRouter() {
    return self::where('default', '1')->firstOrFail();
  }
}


