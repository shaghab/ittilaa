<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    //The table associated with the model.
    protected $table = 'x_ministries';

    public static function GetId($ministryName) {
        $ministry = Ministry::where('name',$ministryName)->first();   
        return $ministry->id;
    }
}
