<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Notification;
use App\Tag;
use App\Ministry;
use App\Division;
use App\Region;

trait QueriesNotifications {

	public function GetAllNotifications(){
		return Notification::all();
	}

	public function GetApprovedNotifications(){
		return Notification::latest()->where('approval_status', config('enum.approval_status.approved'));
	}

	public function GetPendingNotifications(){
		return Notification::latest()->where('approval_status', config('enum.approval_status.pending'));
	}

	public function GetRejectedNotifications(){
		return Notification::latest()->where('approval_status', config('enum.approval_status.rejected'));
	}

	public function GetNotificationsWithTags(array $tags){
		$result = DB::table('x_notifications_tags')->whereIn('tag_id', $tags);
		dd($result);
		return $result;
	}

	public function getRegions(){
		return Region::all();
	}

	public function getRegion($id){
		return Region::find($id);
	}

	public function getMinistries(){
		return Ministry::all();
	}

	public function getMinistry($id){
		return Ministry::find($id);
	}

	public function getDivisions(){
		return Division::all();
	}

	public function getDivision($id){
		return Division::find($id);
	}

	public function GetJobs(){
		return Notification::latest()->where('cateogry', config('enum.notification_categories.job'));
	}

	public function GetNotices(){
		return Notification::latest()->where('cateogry', config('enum.notification_categories.notice'));
	}

	public function GetTenders(){
		return Notification::latest()->where('cateogry', config('enum.notification_categories.tender'));
	}

	public function GetPolicies(){
		return Notification::latest()->where('cateogry', config('enum.notification_categories.policy'));
	}

	public function GetNews(){
		return Notification::latest()->where('cateogry', config('enum.notification_categories.news'));
	}

	public function GetNotificationsFromMinistry($name){
		$ministry = Ministry::where('name', $name);
		return Notification::where('ministry_id', $ministry->id);
	}

	public function GetNotificationsFromDivision($name){
		$division = Division::where('name', $name);
		return Notification::where('division_id', $division->id);
	}

	public function GetNotificationsFromRegion($name){
		$region = Region::where('name', $name);
		return Notification::where('region_id', $region->id);
	}

}