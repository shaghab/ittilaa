<?php

namespace App\Traits;

use App\Permission;
use App\Role;

trait HasRolesAndPermissions {

  /**
   * @return mixed
   */
  public function roles() {
    return $this->belongsToMany(Role::class,'x_users_roles');
  }

  /**
   * @return mixed
   */
  public function permissions() {
    return $this->belongsToMany(Permission::class,'x_users_permissions');
  }

  /**
   * @param $roles (array) 
   * summary: check whether the current user’s roles contain the given role in $roles
   * @return bool
   */
  public function hasRole( ... $roles ) {
    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role))
        return true;
    }
    return false;
  }

  /**
   * @param $permission
   * Summary: Check if the user’s permissions contain the given permission
   * @return bool
   */
  protected function hasPermission($permission) {
    return (bool) $this->permissions->where('slug', $permission->slug)->count();
  }

  /**
   * @param $permission
   * Summary: will check between two conditions: hasPermission and  hasPermissionThroughRole 
   * @return bool
   */
  public function hasPermissionTo($permission) {
    return $this->hasPermissionThroughRole($permission) || 
           $this->hasPermission($permission);
  }

  /**
   *@param $permission
   *Summary: checks if the permission’s role is attached to the user or not.
   *@return bool
   */
  public function hasPermissionThroughRole($permission) {
    foreach ($permission->roles as $role){
      if($this->roles->contains($role))
        return true;
    }
    return false;
  }

  /**
   * @param $permissions
   * Summary: get all permissions based on an array passed
   * @return bool
   */
  protected function getAllPermissions(array $permissions) {
    return Permission::whereIn('slug',$permissions)->get();
  }

  /**
   * @param $permissions
   * Summary: get all permissions from the database based on the array.
   * @return this
   */
   public function givePermissionsTo(... $permissions) {
    $permissions = $this->getAllPermissions($permissions);
    dd($permissions);
    if($permissions === null)
      return $this;

    $this->permissions()->saveMany($permissions);
    return $this;
  }

  /**
   * @param mixed ...$permissions
   * Summary: delete permissions
   * @return $this
   */
  public function deletePermissions(... $permissions ) {
    $permissions = $this->getAllPermissions($permissions);
    $this->permissions()->detach($permissions);
    return $this;
  }

  /**
   * @param $permissions
   * Summary: removes all permissions for a user and then reassign the permissions provided for a user.
   * return $this
   */
  public function refreshPermissions( ... $permissions ) {
    $this->permissions()->detach();
    return $this->givePermissionsTo($permissions);
  }

  /**
   * @param $permissions
   * Summary: removes all permissions for a user
   * return $this
   */
  public function withdrawPermissionsTo( ... $permissions ) {
    $permissions = $this->getAllPermissions($permissions);
    $this->permissions()->detach($permissions);
    return $this;
  }

}