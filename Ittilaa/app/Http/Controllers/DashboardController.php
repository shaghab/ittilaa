<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller 
{
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    	$this->middleware('permission:approve-notifications', ['only' => ['import']]);
    }

    public function import(){
    	return view('pages.import_csv', ['title' => 'Import CSV File']);
    }

    public function batchStore(Request $request){

        if($request->hasFile('csv_file'))
        {
            $file = $request->file('csv_file');
            dd($file);

            $extension = $file->getClientOriginalExtension();
            dd($extension);

			if ($extension == 'csv') {

			}

			Storage::disk('data')->put(time(). $cover->getFilename().'.'.$extension, File::get($file));

            $storedFile = $file->move('notifications/documents', $originalname);
            $data['notice_link'] = 'notifications/documents/' . $originalname;
            $filePath = $storedFile->getRealPath();
            $data['notice_doc_type'] = pathinfo($filePath)['extension'];
        }
    }

    /**
     * Display a listing of the pending resource waiting for approval.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_index() {
    	//TODO: add data to pass
		return view('pages.admin', ['title' => 'Pending Notifications']);
    }

    /**
     * Display a listing of the approved resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved_index() {
    	//TODO: add data to pass
        return view('pages.admin', ['title' => 'Approved Notifications']);
    }

    /**
     * Display a listing of the rejected resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejected_index() {
    	//TODO: add data to pass
    	return view('pages.admin', ['title' => 'Pending Notifications']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    	//TODO: add data to pass
        return view('pages.data_entry_form');
    }

}