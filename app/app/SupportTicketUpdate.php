<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;

class SupportTicketUpdate extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


