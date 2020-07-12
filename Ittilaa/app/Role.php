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
     
     public function users() {
     
        return $this->belongsToMany(User::class,'x_users_roles');
            
     }
}
