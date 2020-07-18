<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\Permission;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user permissions
        $approve = Permission::where('name','approve-notifications')->first();
        $create = Permission::where('name','create-notifications')->first();
        $feedback = Permission::where('name','give-feedback')->first();
        $view = Permission::where('name','view-notifications')->first();

        // user roles
        $guest_role = Role::where('name','guest')->first();
        $member_role = Role::where('name', 'member')->first();
        $operator_role = Role::where('name','data-operator')->first();
        $admin_role = Role::where('name', 'admin')->first();

        // add admin
		$user = new User();
		$user->name = 'admin';
		$user->email = 'ittilaa.pk@gmail.com';
        $user->password = Hash::make('admin@1234');
        $user->role_id = $admin_role->id;
        $user->save();

        // add operator account
        // TODO: change email address at least
		$operator = new User();
		$operator->name = 'operator';
		$operator->email = 'test@test.com';
        $operator->password = Hash::make('secrettt');
        $operator->role_id = $operator_role->id;
		$operator->save();

    }
}
