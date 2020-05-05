<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SystemStatusUpdate;

class SystemStatusCategory extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "system_status_categories";
  public function checkStatus() {
    $update = SystemStatusUpdate::where('category_id', $this->id)->orderBy('updated_at','DESC')->first();
    if (!$update) {
      return "UP";
    }
    return $update->status;
  }
}


