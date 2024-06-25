<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ApiResource;
use App\Helpers\MainHelper;
use DB;
use Schema;

class CustomizationsGroup2 extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table ='customizations_group2';
  protected $casts = array(
  );

  public function toArray() {
    $result = parent::toArray();
    return $result;
  }
 
}


