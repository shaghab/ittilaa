<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Notification;
use App\Traits\QueriesNotifications;

class NotificationsController extends Controller
{
    use QueriesNotifications;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('permission:create-notifications', ['only' => ['create', 'edit', 'store', 'update']]);
        $this->middleware('permission:approve-notifications', ['only' => [  'pending_index', 
                                                                            'approved_index', 
                                                                            'rejected_index', 
                                                                            'approve', 
                                                                            'reject',
                                                                            'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // TODO: save these in pagination settings later
        $perPage = 10;
        $perRow = 5;
        $rowCount = ceil($perPage / $perRow);

        $notifications = $this->GetApprovedNotifications()->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.home', [ 'notifications' => $notifications, 
                                    'tab'       => 'index',
                                    'count'     => $count,
                                    'perPage'   => $perPage,
                                    'perRow'    => $perRow,
                                    'rowCount' => $rowCount ]);
    }

    /**
     * Display a listing of the pending resource waiting for approval.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_index() {
        // TODO: save these in pagination settings later
        $perPage = 4;
        $perRow = 1;
        $rowCount = ceil($perPage / $perRow);

        $notifications = $this->GetPendingNotifications()->paginate($perPage);

        return view('pages.admin', ['notifications' => $notifications, 
                                    'tab' => 'pending',
                                    'count' => $notifications->count(),
                                    'perPage' => $perPage,
                                    'perRow' => $perRow,
                                    'rowCount' => $rowCount]);
    }

    /**
     * Display a listing of the approved resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved_index() {
        // TODO: save these in pagination settings later
        $perPage = 4;
        $perRow = 1;
        $rowCount = ceil($perPage / $perRow);
        
        $notifications = $this->GetApprovedNotifications()->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.admin', ['notifications' => $notifications, 
                                    'tab' => 'approved',
                                    'count' => $count,
                                    'perPage' => $perPage,
                                    'perRow' => $perRow,
                                    'rowCount' => $rowCount]);
    }

    /**
     * Display a listing of the rejected resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejected_index() {
        // TODO: save these in pagination settings later
        $perPage = 4;
        $perRow = 1;
        $rowCount = ceil($perPage / $perRow);

        $notifications = $this->GetRejectedNotifications()->paginate($perPage);
        $count = $notifications ? $notifications->count() : 0;

        return view('pages.admin', ['notifications' => $notifications, 
                                    'tab' => 'rejected',
                                    'count' => $count,
                                    'perPage' => $perPage,
                                    'perRow' => $perRow,
                                    'rowCount' => $rowCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.data_entry_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'thumbnail_link' => 'required',
            'notice_link' => 'required',
            'description' => 'required',
            'region_id' => 'required',
            'region_name' => 'required',
            'division_id' => 'required',
            'division_name' => 'required',
            'ministry_id' => 'required',
            'ministry_name' => 'required',
            'signing_authority' => 'required',
            'notifier' => 'required',
            'notifier_designation' => 'required',
            'publish_date' => 'required',
            'source_url' => 'required',
            'operator_id',
        ]);

        $data['notice_doc_type'] = (Str::endsWith(Str::of($data['notice_link'])->lower(), 'pdf')) ? 'IMAGE' : 'PDF';
        $data['creation_date'] = Carbon::now();
        $notification = Notification::create($data);

        // TODO: send to proper link
        return $notification;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $notification = Notification::find($id);
        return view('pages.data_entry_form', ['notification', $notification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $notification = Notification::find($id);
        if ($notification != null) {
            $data = $request->validate([
                'title' => 'required',
                'category' => 'required',
                'thumbnail_link' => 'required',
                'notice_link' => 'required',
                'description' => 'required',
                'region_id' => 'required',
                'region_name' => 'required',
                'division_id' => 'required',
                'division_name' => 'required',
                'ministry_id' => 'required',
                'ministry_name' => 'required',
                'signing_authority' => 'required',
                'notifier' => 'required',
                'notifier_designation' => 'required',
                'publish_date' => 'required',
                'source_url' => 'required',
            ]);

            $data['notice_doc_type'] = (Str::endsWith(Str::of($data['notice_link'])->lower(), 'pdf')) ? 'IMAGE' : 'PDF';
            $notification->update($data);

            // TODO: send to proper link
            return $notification;
        }

        return redirect()->route('products.index')->with('success','Notification updated');
    }

    /**
     * Show the form to approve the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id) {
        $notification = Notification::find($id);
        if ($notification != null) {
            $notification->update([
                'approval_status' => config('enum.approval_status.approved'),
                'approver_id' => auth()->user()->id,
                'approval_date' => Carbon::now(),
                ]);

            return redirect()->route('pending')->with('success','Notification approved.');
        }

        return redirect()->route('pending')->with('failed','Notification not approved.');
    }

    /**
     * Show the form to reject the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id) {
        $notification = Notification::find($id);
        if ($notification != null) {
            $notification->update([
                'approval_status' => config('enum.approval_status.rejected'),
                'approver_id' => auth()->user()->id,
                ]);

            return redirect()->route('pending')->with('success','Notification rejected.');
        }
    
        return redirect()->route('pending')->with('failed','Notification not rejection.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $notification = Notification::find($id);
        if ($notification != null) {
            $notification->delete();
        }

        // TODO: send to proper link
        // return redirect()->route('items.index')
        //                 ->with('success','Item deleted successfully');
    }
}
