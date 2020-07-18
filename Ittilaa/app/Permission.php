<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Permission extends Model
{
    //The table associated with the model.
   protected $table = 'x_permissions';

   public function roles() {
      return $this->belongsToMany(Role::class,'x_roles_permissions');
   }
}
