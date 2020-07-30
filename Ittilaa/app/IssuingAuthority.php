<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuingAuthority extends Model
{
    //
    protected $table = 'x_issuing_authorities';

    protected $fillable = [
    	'name',
    	'designation',
    	'unit_name',
    	'unit_type',
    ];

    public static function getAuthorizerDesignations() {
        return IssuingAuthority::select('designation')->distinct();
    }

    public static function getOrganizationUnits() {
        return IssuingAuthority::select('unit_name')->get();//->distinct();
    }

    public static function getIdsFromUnits($unit) {
        return IssuingAuthority::where('unit_name',$name)->select(['id'])->get();
    }

    public static function getIdsFromDesignations($designation) {
        return IssuingAuthority::where('designation',$designation)->select(['id'])->get();
    }
}
