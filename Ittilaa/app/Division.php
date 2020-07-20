<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //The table associated with the model.
    protected $table = 'x_divisions';

    public static function GetId($name) {
        $division = Division::where('name',$name)->first();   
        return $division->id;
    }
}
