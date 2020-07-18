<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //The table associated with the model.
   protected $table = 'x_roles';

   public function permissions() { 
      return $this->belongsToMany(Permission::class,'x_roles_permissions');
   }

   public static function GetId($roleName) {
      $role = Role::where('name',$roleName)->first();   
      return $role->id;
   }

}
