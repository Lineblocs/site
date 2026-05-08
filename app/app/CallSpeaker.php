<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallSpeaker extends Model
{
    const UPDATED_AT = null;

    protected $dates = ['created_at'];
    protected $guarded = array('id');

    public function call()
    {
        return $this->belongsTo('App\Call');
    }

    public function actionItems()
    {
        return $this->hasMany('App\CallActionItem', 'speaker_id');
    }
}
