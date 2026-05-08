<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallActionItem extends Model
{
    const UPDATED_AT = null;

    protected $dates = ['created_at'];
    protected $guarded = array('id');

    public function call()
    {
        return $this->belongsTo('App\Call');
    }

    public function speaker()
    {
        return $this->belongsTo('App\CallSpeaker', 'speaker_id');
    }
}
