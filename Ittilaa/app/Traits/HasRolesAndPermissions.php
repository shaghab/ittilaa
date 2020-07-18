<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Permission;
use App\Role;

trait HasRolesAndPermissions {

  /**
   * @param $roleName 
   * summary: Check whether $roles has user’s role or not
   * @return bool
   */
  public function hasRole($roleName) {
    $role = Role::where('name', $roleName)->first();
    return ($this->role_id === $role->id);
  }

  /**
   * @param $roleName
   * summary: Change user’s role
   * @return bool
   */
  public function changeRole($roleName) {
    $role = Role::where('name', $roleName)->first();
    $this->role_id = $role->id;
  }

  /**
   *@param $permission
   *Summary: checks if the permission’s role is attached to the user role or not.
   *@return bool
   */
  public function hasPermissionTo($permission) {

    $permissions = DB::table('x_roles_permissions')
                      ->rightJoin('x_permissions', 'x_permissions.id', '=', 'x_roles_permissions.permission_id')
                      ->where('x_roles_permissions.role_id', $this->role_id)
                      ->select('name')
                      ->get();

    return (bool) ($permissions->where('name', $permission)->count()); 
  }

  /**
   * @param $permissions
   * Summary: get all permissions based on an array passed
   * @return bool
   */
  protected function getAllPermissions(array $permissions) {
    return Permission::whereIn('name', $permissions)->get();
  }


  // TODO: enable and change code in case later decide to give specific permissions to user
  // regardless of role
  // /**
  //  * @param $permissions
  //  * Summary: get all permissions from the database based on the array.
  //  * @return this
  //  */
  // public function givePermissionsTo(... $permissions) {
  //   $permissions = $this->getAllPermissions($permissions);
  //   if($permissions === null)
  //     return $this;

  //   $this->permissions()->saveMany($permissions);
  //   return $this;
  // }

  // /**
  //  * @param mixed ...$permissions
  //  * Summary: delete permissions
  //  * @return $this
  //  */
  // public function deletePermissions(... $permissions ) {
  //   $permissions = $this->getAllPermissions($permissions);
  //   $this->permissions()->detach($permissions);
  //   return $this;
  // }

  // /**
  //  * @param $permissions
  //  * Summary: removes all permissions for a user and then reassign the permissions provided for a user.
  //  * return $this
  //  */
  // public function refreshPermissions( ... $permissions ) {
  //   $this->permissions()->detach();
  //   return $this->givePermissionsTo($permissions);
  // }

  // /**
  //  * @param $permissions
  //  * Summary: removes all permissions for a user
  //  * return $this
  //  */
  // public function withdrawPermissionsTo( ... $permissions ) {
  //   $permissions = $this->getAllPermissions($permissions);
  //   $this->permissions()->detach($permissions);
  //   return $this;
  // }

}