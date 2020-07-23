<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Notification;
use App\Tag;
use App\Ministry;
use App\Division;
use App\Region;

trait QueriesNotifications {

    public function getNotifications() {
        return Notification::where('approval_status', config('enum.approval_status.approved'))
                            ->orderBy('publish_date', 'desc');
    }

    public function getNotificationInRegion($region) {
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('region_name', $region);
		}

		return $notifications;
    }

    public function getNotificationFromUnit($unit) {
        $notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('unit_name', $unit);
		}

		return $notifications;
    }

	public function GetNotificationsWithTags(array $tags){
		$result = DB::table('x_notifications_tags')->whereIn('tag_id', $tags);
		dd($result);
		return $result;
	}

	public function getNotificationOfCategory($category) {
        $notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('category', $category);
		}

		return $notifications;
    }

	public function GetJobs(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.JOB'));
		}

		return $notifications;
	}

	public function GetNotices(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.NOTICE'));
		}

		return $notifications;
	}

	public function GetTenders(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.TENDER'));
		}

		return $notifications;
	}

	public function GetPolicies(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.POLICY'));
		}

		return $notifications;
	}

	public function GetNews(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.NEWS'));
		}

		return $notifications;
	}

}