<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallChapter extends Model
{
    public $timestamps = false;

    protected $guarded = array('id');

    public function call()
    {
        return $this->belongsTo('App\Call');
    }
}
