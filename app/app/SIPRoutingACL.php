<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SIPRoutingACL extends Model {

  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
  protected $table = "sip_routing_acl";
}


