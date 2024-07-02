<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use DB;
use Schema;

class CustomizationsKVStore extends SettingsKVStoreModel {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table ='customizations_kv_store';
  protected $casts = array(
  );

  public function toArray() {
    $result = parent::toArray();
    return $result;
  }
 
}


