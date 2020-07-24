<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use App\Notification;
use App\Tag;
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

        $categories = config('enum.notification_categories');
        $regions = $this->getRegions();
        $ministries = $this->getMinistries();
        $divisions = $this->getDivisions();

        return view('pages.data_entry_form', [  'categories' => $categories,
                                                'regions' => $regions,
                                                'ministries' => $ministries,
                                                'divisions' => $divisions
                                            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($data);
        
        $fields = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'thumbnail_file' => 'required',
            'notice_file' => 'required',
            'region' => 'required',
            'division' => 'required',
            'signing_authority' => 'nullable',
            'notifier' => 'nullable',
            'notifier_designation' => 'nullable',
            'source_url' => 'nullable',
        ]);

        $data = [   'title' => $request->title,
                    'category' => $request->category,
                    'description' => $request->description, 
                ];

        if($request->hasFile('notice_file'))
        {
            $file = $request->file('notice_file');
            $originalname = $file->getClientOriginalName();
            $storedFile = $file->move('notifications/documents', $originalname);
            $data['notice_link'] = 'notifications/documents/' . $originalname;
            $filePath = $storedFile->getRealPath();
            $data['notice_doc_type'] = pathinfo($filePath)['extension'];
        }

        if($request->hasFile('thumbnail_file'))
        {
            $file = $request->file('thumbnail_file');
            $originalname = $file->getClientOriginalName();
            $storedFile = $file->move('notifications/thumbnails', $originalname);
            $data['thumbnail_link'] = 'notifications/thumbnails/' . $originalname;
        }

        // TODO: add datetime picker
        $datetime = new DateTime(); 
        $datetime->setDate('2020', '06', '25');
        $data['publish_date'] = $datetime;

        $region = $this->getRegion($fields['region']);
        $data['region_id'] = $region->id;
        $data['region_name'] = $region->name;

        $division = $this->getDivision($fields['division']);
        $data['division_id'] = $division->id;
        $data['division_name'] = $division->name;;
        $data['ministry_id'] = $division->ministry_id;

        $ministry = $this->getMinistry($division->ministry_id);
        $data['ministry_name'] = $ministry->name;

        $data['signing_authority'] = $fields['signing_authority'];
        $data['notifier'] = $fields['notifier'];
        $data['notifier_designation'] = $fields['notifier_designation'];
        $data['source_url'] = $fields['source_url'];

        $data['operator_id'] = auth()->user()->id;
        $data['approval_status'] = config('enum.approval_status.pending');
        $data['creation_date'] = Carbon::now();

        $notification = Notification::create($data);

        if($notification) {        
            $tagNames = explode(',',$request->get('tags'));

            foreach($tagNames as $tagName)  {
                $tag = Tag::where('name', $tagName)->first();
                
                if(!$tag) {
                    $tag = new Tag();
                    $tag->name = $tagName;
                    $tag->save();
                }

                $notification->tags()->attach($tag);
            }
    }

        // TODO: send to proper link
        return $this->create();
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
        //TODO: not correct
        $notification = Notification::find($id);
        return view('pages.data_entry_form', ['notification' => $notification]);
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
