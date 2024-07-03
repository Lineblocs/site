<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;
use App\Helpers\MainHelper;

class SupportTicketCategory extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "support_tickets_categories";

  public static function asSelect() {
    $all = self::all();
    $results = [];
    foreach ($all as $item) {
      $results[ $item->id ] = $item->name;
    }
    return $results;
  }
}


