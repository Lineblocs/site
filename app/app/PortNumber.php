<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortNumber extends PublicResource {
  public static $publicPrefix = "p";
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "port_numbers";
  protected $statuses = array(
      "pending-review",
      "received",
      "submitted-to-provider",
      "confirmed",
      "completed"
  );
}


