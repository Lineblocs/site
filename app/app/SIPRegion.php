<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SIPRateCenter;

class SIPRegion extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "sip_regions";
  public function getRateCenters() {
    return SIPRateCenter::where('region_id', $this->id)->where('active', '1')->get();
    }
  public function countRateCenters() {
    return SIPRateCenter::where('region_id', $this->id)->where('active', '1')->count();
  }

}


