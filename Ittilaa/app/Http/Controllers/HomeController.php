<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\QueriesNotifications;
use App\Category;
use App\IssuingAuthority;
use App\Notification;
use App\Region;

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
