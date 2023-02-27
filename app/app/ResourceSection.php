<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceSection extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "resource_sections";
  public static function asSelect() {
    $items = ResourceSection::all();
    $results = [];
    foreach ( $items as $item_db ){
      $results[$item_db->id] = $item_db->name;
    }
    return $results;
  }
}


