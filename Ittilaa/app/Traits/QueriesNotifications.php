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

    public function getNotificationInRegion($region_id) {
		$notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('region_id', $region_id);
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

	public function getNotificationOfCategory($category_id) {
        $notifications = $this->getNotifications();
		if ($notifications->count()) {
			return $notifications->where('category_id', $category_id);
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