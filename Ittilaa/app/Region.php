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

    public static function getId($name) {
        $region = Region::where('name', $name)->first();        
        if ($region) {
            return $region->id;
        }

        return -1;
    }

    public static function getRegions() {
        return Region::all();
    }

    public static function create($name) {
        $region_id = Region::getId($name);
        // dd($region_id);
        if ($region_id == -1) {
            return Region::create(['name' => $name]);
        }

        return Region::find($region_id);
    }
}
