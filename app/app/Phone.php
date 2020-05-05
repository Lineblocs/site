<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;

class Phone extends PublicResource {
  public static $publicPrefix = "p";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "phones";
  public function getStrippedMacAddress() {

      return strtolower(str_replace(":", "", $this->mac_address));
  }
}


