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
        $admin_perm = Permission::where('slug','approve-notifications')->first();
        $operator_perm = Permission::where('slug','create-notifications')->first();
        $member_perm = Permission::where('slug','give-feedback')->first();
        $guest_perm = Permission::where('slug','view-notifications')->first();

        // user roles
        $guest_role = Role::where('slug','guest')->first();
        $member_role = Role::where('slug', 'member')->first();
        $operator_role = Role::where('slug','data-operator')->first();
        $admin_role = Role::where('slug', 'admin')->first();

        // fake user data
		$admin = new User();
		$admin->name = 'Admin';
		$admin->email = 'admin@gmail.com';
		$admin->password = bcrypt('secrettt');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->attach($admin_perm);

		$operator = new User();
		$operator->name = 'Opera';
		$operator->email = 'opera@gmail.com';
		$operator->password = bcrypt('secrettt');
		$operator->save();
		$operator->roles()->attach($operator_role);
        $operator->permissions()->attach($operator_perm);

        foreach (range(1,3) as $index) {
            $guest = new User();
            $guest->name = 'user' . $index;
            $guest->email = 'user' . $index . '@gmail.com';
            $guest->password = bcrypt('secrettt');
            $guest->save();
            $guest->roles()->attach($guest_role);
            $guest->permissions()->attach($guest_perm);
        }

    }
}
