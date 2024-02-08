<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PublicResource;
use App\Helpers\MainHelper;

class SupportTicket extends PublicResource {
  public static $publicPrefix = "st";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  public static $apiPrefix = "st";

}


