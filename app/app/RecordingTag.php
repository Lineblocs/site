<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordingTag extends Model {
  protected $dates = ['created_at', 'updated_at'];

  protected $guarded  = array('id');
}


