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

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();
        $searchTags = array(
            'search_text' => '',
            'region_filter' => '',
            'department_filter' => '',
            'category_filter' => '',
        );

        $notifications = $this->getNotifications()->paginate(config('pagination.home.records_per_page'));
        $notifications->appends($searchTags);

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $searchTags ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string, string, string
     * @return \Illuminate\Http\Response
     */
    public function show($category, $region_name, $slug) {
        $category = str_replace("-", "/", $category);
        $region_name = str_replace("-", " ", $region_name);
        $notification = Notification::where([   ['slug', '=', $slug], 
                                                [DB::raw('LOWER(category)'), '=', $category], 
                                                [DB::raw('LOWER(region_name)'), '=', $region_name]   ])
                                    ->first();

        return view('pages.notification', ['notification' => $notification]);
    }

    /**
     * Display a list of resource w.r.t. params.
     *
     * @param  string, string (can be null)
     * @return \Illuminate\Http\Response
     */
    public function index_cat_region($category, $region_name = null) {

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $category = str_replace("-", "/", $category);
        $notifications = Notification::where(DB::raw('LOWER(category)'), $category);
        if ($region_name){
                $region_name = str_replace("-", " ", $region_name);
                $notifications = $notifications->where(DB::raw('LOWER(region_name)'), $region_name);
        }

        $searchTags = array(
            'search_text' => '',
            'region_filter' => $region_name,
            'department_filter' => '',
            'category_filter' => $category,
        );

        $notifications = $notifications->paginate(config('pagination.home.records_per_page'));
        $notifications->appends($searchTags);

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $searchTags ]);
    }

    /**
     * Display searched list of resource w.r.t param
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
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

        if ($notifications->count() && !empty($filters['search_text'])) {
            $search_text = $request->input('search_text');

            $tag_ids = Tag::where('name','LIKE','%'.$search_text.'%')->get('id');
            $ids = DB::table('x_notifications_tags')->whereIn('tag_id', $tag_ids)->pluck('notification_id');

            $notifications = $notifications->whereIn('id', $ids)
                                           ->orWhere('title', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('region_name', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('unit_name', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('issuing_authority', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('designation', 'LIKE', '%'.$search_text.'%')
                                           ->orWhere('description', 'LIKE', '%'.$search_text.'%');

            $searchTags['search_text'] = $search_text;
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
                                    'filters'       => $searchTags ]);
    }

    /**
     * Display searched list of resource w.r.t. param
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function searchTag($tag){

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();
        $searchTags = array(
            'search_text' => '',
            'region_filter' => '',
            'department_filter' => '',
            'category_filter' => '',
        );

        $notifications = $this->getNotificationsWithTag($tag)
                                    ->paginate(config('pagination.home.records_per_page'));
        $notifications->appends($searchTags);


        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'filters'       => $searchTags ]);
    }
}
