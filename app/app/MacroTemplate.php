<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MacroTemplate extends Model
{
    public static $publicPrefix = "mt";
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = array('id');
}
