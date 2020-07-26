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
        return IssuingAuthority::select('unit_name')->distinct();
    }
}