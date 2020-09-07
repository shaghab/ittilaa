<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Traits\QueriesNotifications;
use App\Category;
use App\IssuingAuthority;
use App\Notification;
use App\Region;
use App\Tag;

class HomeController extends Controller
{
    use QueriesNotifications;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $notifications = $this->getNotifications()->paginate(config('pagination.home.records_per_page'));
        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $notification = Notification::find($id);
        return view('pages.notification', ['notification' => $notification]);
    }

    public function search(Request $request){

        $filters = array();

        $notifications = $this->getNotifications();

        if ($notifications->count() && $request->has('search_text')) {
            $search_text = $request->input('search_text');
            $filters['search_text'] = $search_text;

            $tag_ids = Tag::where('name','LIKE','%'.$search_text.'%')->get('id');
            $ids = DB::table('x_notifications_tags')->whereIn('tag_id', $tag_ids)->pluck('notification_id');

            $notifications = $notifications->whereIn('id', $ids);

        }

        if ($notifications->count() && $request->has('region_id')) {
            $region_id = $request->input('region_id');
            $filters['region_id'] = $region_id;
            $notifications = $notifications->where('region_id', $region_id);
        }

        if ($notifications->count() && $request->has('unit_name')) {
            $unit_name = $request->input('unit_name');
            $filters['unit_name'] = $unit_name;
            $notifications = $notifications->where('unit_name', $unit_name);
        }

        if ($notifications->count() && $request->has('category_id')) {
            $category_id = $request->input('category_id');
            $filters['category_id'] = $category_id;
            $cat = Category::find($category_id);

            if (empty($cat->level_1)) {
                $cat_ids = Category::where('name', $cat->name)->get('id');
                $notifications = $notifications->whereIn('category_id', $cat_ids);
            }
            else {
                $notifications = $notifications->where('category_id', $category_id);
            }
        }

        $notifications = $notifications->paginate(config('pagination.home.records_per_page'));
        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'search_text'   => $search_text]);

    }

    public function searchRegion(Request $request) {

        $fields = $request->validate(['region_id' => 'required']);
        $regionId = $fields['region_id'];
        $notifications = $this->getNotificationInRegion($regionId)
                                    ->paginate(config('pagination.home.records_per_page'));

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'region_id'     => $regionId,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments]);
    }

    public function searchDepartment(Request $request) {

        $fields = $request->validate(['department' => 'required']);
        $unitName = $fields['department'];
        $notifications = $this->getNotificationFromUnit($unitName)
                                    ->paginate(config('pagination.home.records_per_page'));

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'department'    => $unitName]);
    }

    public function searchCategory(Request $request){

        $fields = $request->validate(['category_id' => 'required']);
        $categoryId = $fields['category_id'];
        $notifications = $this->getNotificationOfCategory($categoryId)
                                    ->paginate(config('pagination.home.records_per_page'));

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'category_id'   => $categoryId,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments]);
    }

    public function searchNotifications(Request $request){
        $fields = $request->validate(['search_text' => 'required']);
        $search_text = $fields['search_text'];
        $notifications = $this->search($search_text)
                                    ->paginate(config('pagination.home.records_per_page'));

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments]);
    }

    public function searchTag($tag){

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $notifications = $this->getNotificationsWithTag($tag)
                                    ->paginate(config('pagination.home.records_per_page'));

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'category_id'   => $tag,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments]);
    }

}
