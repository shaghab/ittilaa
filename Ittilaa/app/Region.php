<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //The table associated with the model.
    protected $table = 'x_regions';

    protected $fillable = [
    	'name',
    ];

    public static function GetId($name) {
        $region = Region::where('name',$name)->first();
        return $region->id;
    }

    public static function getRegions() {
        return Region::select('name')->get();
    }
}
