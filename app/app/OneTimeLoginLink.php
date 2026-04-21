<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneTimeLoginLink extends Model
{
    protected $table = 'one_time_login_links';
    protected $guarded = array('id');
}

