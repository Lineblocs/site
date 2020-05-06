<?php 
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
class ErrorUserTrace extends Model {

    protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "error_user_trace";
}
