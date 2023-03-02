<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicResource extends Model
{
    public static function create($attrs = array())
    {
        $attrs['public_id'] = Str::uuid()->toString();
        return parent::create($attrs);
    }

}
