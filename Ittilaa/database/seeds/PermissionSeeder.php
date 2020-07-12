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
		$approve_notifications->slug = 'approve-notifications';
		$approve_notifications->name = 'Approve Notifications';
		$approve_notifications->save();

		$create_notifications = new Permission();
		$create_notifications->slug = 'create-notifications';
		$create_notifications->name = 'Create Notifications';
		$create_notifications->save();

        $give_feedback = new Permission();
		$give_feedback->slug = 'give-feedback';
		$give_feedback->name = 'Give Feedback';
		$give_feedback->save();

		$view_notifications = new Permission();
		$view_notifications->slug = 'view-notifications';
		$view_notifications->name = 'View Notifications';
		$view_notifications->save();

    }
}
