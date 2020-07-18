<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user permissions
        $approve_notif = Permission::where('name','approve-notifications')->first();
        $create_notif = Permission::where('name','create-notifications')->first();
        $give_feedback = Permission::where('name','give-feedback')->first();
        $view_notif = Permission::where('name','view-notifications')->first();

        // user roles
        $guest_role = Role::where('name','guest')->first();
        $guest_role->permissions()->attach($view_notif); 

        $member_role = Role::where('name', 'member')->first();
        $member_role->permissions()->attach($view_notif); 
        $member_role->permissions()->attach($give_feedback); 

        $operator_role = Role::where('name','data-operator')->first();
        $operator_role->permissions()->attach($view_notif); 
        $operator_role->permissions()->attach($create_notif);

        $admin_role = Role::where('name', 'admin')->first();
        $admin_role->permissions()->attach($view_notif); 
        $admin_role->permissions()->attach($give_feedback); 
        $admin_role->permissions()->attach($create_notif);
        $admin_role->permissions()->attach($approve_notif);

    }
}
