<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WorkspaceSIPWebhook extends Model {

  protected $dates = ['created_at', 'updated_at', 'expires_on'];

  protected $guarded  = array('id');
  protected $table = "workspaces_sip_webhooks";
}


