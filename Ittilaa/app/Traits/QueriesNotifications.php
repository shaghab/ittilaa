<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Notification;
use App\Tag;
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

	public function getNotificationsWithTags(array $tags){
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

	public function getJobs(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.JOB'));
		}

		return $notifications;
	}

	public function getNotices(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.NOTICE'));
		}

		return $notifications;
	}

	public function getTenders(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.TENDER'));
		}

		return $notifications;
	}

	public function getPolicies(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.POLICY'));
		}

		return $notifications;
	}

	public function getNews(){
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('cateogry', config('enum.notification_categories.NEWS'));
		}

		return $notifications;
	}

}