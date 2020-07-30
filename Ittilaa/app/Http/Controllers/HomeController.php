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
        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $notifications = $this->getNotifications()->paginate(config('pagination.home.records_per_page'));
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count, ]);
    }

    public function searchRegion(Request $request) {

        $fields = $request->validate(['region_id' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $notifications = $this->getNotificationInRegion($fields['region_id'])
                                    ->paginate(config('pagination.home.records_per_page'));
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count, ]);
    }

    public function searchDepartment(Request $request) {

        $fields = $request->validate(['department' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $notifications = $this->getNotificationFromUnit($fields['department'])
                                    ->paginate(config('pagination.home.records_per_page'));
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count, ]);
    }

    public function searchCategory(Request $request){

        $fields = $request->validate(['category_id' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = Category::getCategories();

        $notifications = $this->getNotificationOfCategory($fields['category_id'])
                                    ->paginate(config('pagination.home.records_per_page'));
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'category_id'   => $fields['category_id'],
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count, ]);
    }

}
