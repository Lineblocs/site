<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SIPProvider extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "sip_providers";
  public static function asSelect($addEmptyOption = false) {
    $list = [];
    $items = self::all();
    if ($addEmptyOption) {
      $list[""] = "Select SIP Provider";
    }
    foreach ( $items as $item ) {
      $list[ $item->id ] = $item->name;
    }
    return $list;
  }
}


