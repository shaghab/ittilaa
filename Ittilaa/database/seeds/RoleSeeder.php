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
		$guest_role->name = 'guest';
		$guest_role->save();

		$member_role = new Role();
		$member_role->name = 'member';
		$member_role->save();

        $operator_role = new Role();
		$operator_role->name = 'data-operator';
		$operator_role->save();

		$admin_role = new Role();
		$admin_role->name = 'admin';
		$admin_role->save();
    }
}
