<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Notification;
use App\Tag;
use App\Region;
use App\Category;

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

	public function getNotificationsWithTag($tag_id){
        $notifications = $this->getNotifications();
		if ($notifications->count()) {
			$ids = DB::table('x_notifications_tags')->where('tag_id', $tag_id)->pluck('notification_id');
			return $notifications->whereIn('id', $ids);
		}

		return $notifications;
	}

	public function getNotificationOfCategory($category_id) {
        $notifications = $this->getNotifications();
		if ($notifications->count()) {
			$cat = Category::find($category_id);
			if (empty($cat->level_1)){
				$cat_ids = Category::where('name', $cat->name)->get('id');
				return $notifications->whereIn('category_id', $cat_ids);
			}

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