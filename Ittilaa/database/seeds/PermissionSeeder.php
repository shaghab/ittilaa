<?php

use Illuminate\Database\Seeder;

use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permissions
		$approve_notifications = new Permission();
		$approve_notifications->name = 'approve-notifications';
		$approve_notifications->save();

		$create_notifications = new Permission();
		$create_notifications->name = 'create-notifications';
		$create_notifications->save();

        $give_feedback = new Permission();
		$give_feedback->name = 'give-feedback';
		$give_feedback->save();

		$view_notifications = new Permission();
		$view_notifications->name = 'view-notifications';
		$view_notifications->save();

    }
}
