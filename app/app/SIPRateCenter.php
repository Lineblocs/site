<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SIPRateCenter extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table  = "sip_rate_centers";
  public function hasProvider($currentProviders, $provider) {
    foreach ($currentProviders as $cProvider) {
      if ($cProvider->provider_id ==$provider->id) {
        return TRUE;
      }
    }
    return FALSE;
  }
}


