<?php

use Illuminate\Database\Seeder;

use App\Role; 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        $guest_role = new Role();
		$guest_role->slug = 'guest';
		$guest_role->name = 'Guest';
		$guest_role->save();

		$member_role = new Role();
		$member_role->slug = 'member';
		$member_role->name = 'Member';
		$member_role->save();

        $operator_role = new Role();
		$operator_role->slug = 'data-operator';
		$operator_role->name = 'Data Operator';
		$operator_role->save();

		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin';
		$admin_role->save();
    }
}
