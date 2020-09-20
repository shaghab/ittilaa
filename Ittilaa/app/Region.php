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
        return Region::orderBy('name', 'asc')->get();
    }

    public static function createNew($name) {
        $region_id = Region::getId($name);
        if ($region_id == -1) {
            return Region::create(['name' => $name]);
        }

        return Region::find($region_id);
    }
}
