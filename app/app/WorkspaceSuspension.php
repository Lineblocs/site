<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkspaceSuspension extends Model
{
    public $timestamps = false;

    protected $dates = ['suspended_at'];

    protected $guarded = array('id');
    protected $table = 'workspaces_suspensions';
    protected $casts = array(
        'status' => 'boolean',
        'grace_period_extension' => 'integer',
    );
}
