<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SIPRateCenter;

class SIPPoPRegion extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "sip_pop_regions";
  public static function createSelectOptions($useIDValues=FALSE) {
    $records = self::all();
    $result = [];
    foreach ( $records as $record ) {
      if ($useIDValues) {
        $result[$record->id] = sprintf("%s (%s)", $record->name, $record->code);
      } else {
        $result[$record->code] = sprintf("%s (%s)", $record->name, $record->code);
      }
      // TODO: add foreign keys to sip routers and use IDs as values in SIP router region column
      //$result[$record->id] = sprintf("%s (%s)", $record->name, $record->code);
    }
    return $result;
  }
}


