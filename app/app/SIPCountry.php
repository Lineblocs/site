<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SIPRegion;

class SIPCountry extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "sip_countries";
  public function getRegions() {
    return SIPRegion::where('country_id', $this->id)->get();
  }
}


