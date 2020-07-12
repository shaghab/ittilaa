<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //The table associated with the model.
    protected $table = 'x_permissions';

    public function roles() {

        return $this->belongsToMany(Role::class,'x_roles_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class,'x_users_permissions');
            
     }

}
