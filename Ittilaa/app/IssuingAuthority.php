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

    public static function getAuthorizersNames() {
        return IssuingAuthority::distinct('name')->get();
    }

    public static function getAuthorizerDesignations() {
        return IssuingAuthority::distinct('designation')->get();
    }

    public static function getOrganizationUnits() {
        return IssuingAuthority::select('unit_name')->distinct('unit_name')->get();
    }

    public static function getIdsFromName($names) {
        return IssuingAuthority::where('name', $names)->select(['id'])->get();
    }

    public static function getIdsFromUnit($unit) {
        return IssuingAuthority::where('unit_name',$unit)->select(['id'])->get();
    }

    public static function getIdsFromDesignation($designation) {
        return IssuingAuthority::where('designation', $designation)->select(['id'])->get();
    }

    public static function createNew($data) {
        $authorityExisitsConditions =  ['name' => $data['name'],
                                        'designation' => $data['designation'],
                                        'unit_name' => $data['unit_name']];
                                        
        $authority = IssuingAuthority::where($authorityExisitsConditions)->first();
        if (!$authority) {
            $authority = IssuingAuthority::create (['name' => $data['name'],
                                                    'designation' => $data['designation'],
                                                    'unit_name' => $data['unit_name'],
                                                    'unit_type'=> $data['unit_type']]);
        }

        return $authority;
    }
}
