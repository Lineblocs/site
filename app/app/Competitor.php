<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competitor extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "competitors";

  public static function asSelect() {
    $items = Competitor::all();
    $result = [];
    foreach ($items as $item) {
      $result[$item->id] = $item->name;
    }

    return $result;
  }
}


