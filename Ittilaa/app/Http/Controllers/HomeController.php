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
        $filters = (['search_text' => '', 'region_filter' => '', 'department_filter' => '', 'category_filter' => '']);

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $filters, ]);
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

    public function filter_search(Request $request){

        $filters = $request->validate(['search_text' => 'nullable',
                                       'region_filter' => 'nullable',
                                       'department_filter' => 'nullable',
                                       'category_filter' => 'nullable']);

        $searchTags = array(
            'search_text' => '',
            'region_filter' => '',
            'department_filter' => '',
            'category_filter' => '',
        );

        $notifications = $this->getNotifications();

        if ($notifications->count() && !empty($filters['search_text'])) {
            $search_text = $request->input('search_text');

            $tag_ids = Tag::where('name','LIKE','%'.$search_text.'%')->get('id');
            $ids = DB::table('x_notifications_tags')->whereIn('tag_id', $tag_ids)->pluck('notification_id');

            $notifications = $notifications->whereIn('id', $ids);
            $searchTags['search_text'] = $search_text;
        }

        if ($notifications->count() && !empty($filters['region_filter'])) {
            $region_name = $request->input('region_filter');
            $notifications = $notifications->where('region_name', $region_name);
            $searchTags['region_filter'] = $region_name;
        }

        if ($notifications->count() && !empty($filters['department_filter'])) {
            $unit_name = $request->input('department_filter');
            $notifications = $notifications->where('unit_name', $unit_name);
            $searchTags['department_filter'] = $unit_name;
        }

        if ($notifications->count() && !empty($filters['category_filter'])) {
            $category_id = $request->input('category_filter');
            $cat = Category::find($category_id);

            if (empty($cat->level_1)) {
                $cat_ids = Category::where('name', $cat->name)->get('id');
                $notifications = $notifications->whereIn('category_id', $cat_ids);
            }
            else {
                $notifications = $notifications->where('category_id', $category_id);
            }
            $searchTags['category_filter'] = $category_id;
        }

        $notifications = $notifications->paginate(config('pagination.home.records_per_page'));
        $notifications->appends($searchTags);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $filters, ]);
    }

    public function searchTag($tag){

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();
        $filters = (['search_text' => '', 'region_filter' => '', 'department_filter' => '', 'category_filter' => '']);

        $notifications = $this->getNotificationsWithTag($tag)
                                    ->paginate(config('pagination.home.records_per_page'));


        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $filters, ]);
    }
}
