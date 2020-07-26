<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Region;

class DashboardController extends Controller 
{
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    	$this->middleware('permission:approve-notifications', ['only' => ['import', 'create']]);
    }

    /**
     * Dashboard index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return $this->import();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $categories = config('enum.notification_categories');
        $regions = Region::getRegions();
        return view('pages.data_entry_form', [  'categories' => $categories,
                                                'regions' => $regions, ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // //TODO: not implemented
        // return view('pages.data_entry_form', ['notification' => $notification]);
    }

    /**
     * Shows the form for bulk importing new resources from csv file.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(){
    	return view('pages.import_csv', ['title' => 'Import CSV File', 'file_imported' => false]);
    }

    /**
     * Display a listing of the pending resource waiting for approval.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingIndex() {
    	//TODO: add data to pass
		// return view('pages.admin', ['title' => 'Pending Notifications',
  //                                   'approvingNotifications' => true,]);
    }

    /**
     * Display a listing of the approved resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedIndex() {
    	//TODO: add data to pass
        // return view('pages.admin', ['title' => 'Approved Notifications',
  //                                   'approvingNotifications' => false,]);
    }

    /**
     * Display a listing of the rejected resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectedIndex() {
    	//TODO: add data to pass
    	// return view('pages.admin', ['title' => 'Pending Notifications']),
  //                                   'approvingNotifications' => false,]);
    }



}