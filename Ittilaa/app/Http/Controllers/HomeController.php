<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\QueriesNotifications;
use App\IssuingAuthority;
use App\Notification;
use App\Region;

class HomeController extends Controller
{
    use QueriesNotifications;

    // public array $authorizers;
    // public array $departments;
    // public array $regions;
    // public array $categories;

    // protected int $perPage;
    // protected int $perRow;
    // protected int $rowCount;

    public function __construct() {

        // $this->$authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        // $this->$departments = IssuingAuthority::getOrganizationUnits();
        // $this->$regions = Region::getRegions();
        // $this->$categories = config('enum.notification_categories');

        // // TODO: save these in pagination settings later
        // $this->$perPage = 10;
        // $this->$perRow = 5;
        // $this->$rowCount = 2;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = config('enum.notification_categories');

        // TODO: save these in pagination settings later
        $perPage = 8;
        $perRow = 4;
        $rowCount = 2;
        
        $notifications = $this->getNotifications()->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count,
                                    'perPage'       => $perPage,
                                    'perRow'        => $perRow,
                                    'rowCount'      => $rowCount ]);
    }

    public function searchRegion(Request $request) {

        $fields = $request->validate(['region' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = config('enum.notification_categories');

        // TODO: save these in pagination settings later
        $perPage = 8;
        $perRow = 4;
        $rowCount = 2;

        $notifications = $this->getNotificationInRegion($fields['region'])->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count,
                                    'perPage'       => $perPage,
                                    'perRow'        => $perRow,
                                    'rowCount'      => $rowCount ]);
    }

    public function searchDepartment(Request $request) {

        $fields = $request->validate(['department' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = config('enum.notification_categories');

        // TODO: save these in pagination settings later
        $perPage = 8;
        $perRow = 4;
        $rowCount = 2;

        $notifications = $this->getNotificationFromUnit($fields['department'])->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count,
                                    'perPage'       => $perPage,
                                    'perRow'        => $perRow,
                                    'rowCount'      => $rowCount ]);
    }

    public function searchCategory(Request $request){

        $fields = $request->validate(['category' => 'required']);

        $authorizers = IssuingAuthority::getAuthorizerDesignations(); 
        $departments = IssuingAuthority::getOrganizationUnits();
        $regions = Region::getRegions();
        $categories = config('enum.notification_categories');

        // TODO: save these in pagination settings later
        $perPage = 8;
        $perRow = 4;
        $rowCount = 2;

        $notifications = $this->getNotificationOfCategory($fields['category'])->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'categories'    => $categories,
                                    'regions'       => $regions,
                                    'authorizers'   => $authorizers,
                                    'departments'   => $departments,
                                    'count'         => $count,
                                    'perPage'       => $perPage,
                                    'perRow'        => $perRow,
                                    'rowCount'      => $rowCount ]);
    }

}
