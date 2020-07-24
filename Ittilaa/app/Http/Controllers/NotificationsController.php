<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $this->middleware('permission:create-notifications', ['only' => ['store', 'bulk_import', 'update']]);
        $this->middleware('permission:approve-notifications', ['only' => [  'pending_index', 
                                                                            'approved_index', 
                                                                            'rejected_index', 
                                                                            'approve', 
                                                                            'reject',
                                                                            'destroy']]);
    }

    /**
     * Parse csv file to choose attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function parseFile(Request $request) {

        if ($request->hasFile('csv_file')) {

            $path = $request->file('csv_file')->getRealPath();
            $rawData = array_map('str_getcsv', file($path));
            $rowCount = count($rawData);

            if ($rowCount >= 2){

                $csv_fields = array_slice($rawData, 0, 1);
                $fields = array_map('trim', $csv_fields[0]);
                
                $row = array_slice($rawData, 1, 1);
                $data = array_map('trim', $row[0]);

                $csv_data[0] = $fields;
                $csv_data[1] = $data;
            }
        }

        return view('pages.import_csv', ['title' => 'Import CSV File', 
                                         'file_imported' => true,
                                         'csv_file' => $request['csv_file'],
                                         'csv_data' => $csv_data]);
    }

    /**
     * Bulk import resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processImport(Request $request) {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $fields = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'notice_file' => 'required',
            'thumbnail_file' => 'required',
            'region' => 'required',
            'issuing_authority' => 'nullable',
            'designation' => 'nullable',
            'unit_name' => 'nullable',
            'unit_type' => 'nullable',
            'caption1' => 'nullable',
            'caption2' => 'nullable',
            'caption3' => 'nullable',
            //'publish_date' => 'required',
            'source_url' => 'nullable', ]);

        $data = [   
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description, 
            'issuing_authority'=> $request->issuing_authority,
            'designation' => $request->designation,
            'unit_name' => $request->unit_name,
            'unit_type' => $request->unit_type,
            'caption1' => $request->caption1,
            'caption2' => $request->caption2,
            'caption3' => $request->caption3, ];

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

        $data['operator_id'] = auth()->user()->id;
        $data['approval_status'] = config('enum.approval_status.pending');

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

        return redirect()->route('data_entry');
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
