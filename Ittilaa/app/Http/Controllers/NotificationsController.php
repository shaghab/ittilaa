<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\DataImportFile;
use App\IssuingAuthority;
use App\Notification;
use App\Region;
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
        $this->middleware('permission:create-notifications', ['only' => ['store', 'parseFile', 'processImport', 'update']]);
        $this->middleware('permission:approve-notifications', ['only' => [  'approve', 'reject', 'destroy']]);
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
            $data = [];

            $rowIndex = 0;
            if (($handle = fopen($path, "r")) !== FALSE) {
                while(($row = fgetcsv($handle, 0, ",")) !== FALSE) {
                    $data[$rowIndex++] = array_map('trim', $row);
                }
            }

            $csv_data[0] = $data[0];
            $csv_data[1] = $data[1];

            $csv_data_file = DataImportFile::create([
                'file_name' => $request->file('csv_file')->getClientOriginalName(),
                'has_header_row' => $request->has('has_header'),
                'file_data' => json_encode($data)
            ]);
        }

        return view('pages.import_csv', [
                                        'title' => 'Import CSV File', 
                                        'file_imported' => true,
                                        'csv_data' => $csv_data,
                                        'csv_data_file' => $csv_data_file,
                                        ]);
    }

    /**
     * Bulk import resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processImport(Request $request) {

        $import_file_id = $request->import_file_id;
        $import_file = DataImportFile::find($import_file_id);
        $import_data = json_decode($import_file->file_data, true);

        if ($import_file->has_header_row) {
            unset($import_data[0]);
        }

        $dbFields = config('app.notification_fields');
        $notifications = [];

        foreach ($import_data as $row) {
            $data = [];

            foreach ($dbFields as $index => $field) {
                $data[$field] = $row[$request->fields[$index]];
            }

            if (count(array_filter($data)) == 0) {
                continue;
            }

            try {

                $authorityExisitsConditions = ['name' => $data['issuing_authority'],
                                                'designation' => $data['designation'],
                                                'unit_name' => $data['unit_name']];
                $authority = IssuingAuthority::where($authorityExisitsConditions)->first();
                if (!$authority) {
                    $authority = IssuingAuthority::create(['name' => $data['issuing_authority'],
                                                            'designation' => $data['designation'],
                                                            'unit_name' => $data['unit_name'],
                                                            'unit_type'=> $data['unit_type']]);
                }
                $data['issuer_id'] = $authority->id;
                $data['unit_type'] = $authority->unit_type;

                $tagNames = explode(";", $data['tags']);
                unset($data['tags']);

                $regionName = $data['region_name'];
                $region = Region::where('name', $regionName)->first();
                if (!$region) {
                    $region = Region::create(['name' => $regionName]);
                }
                $data['region_id'] = $region->id;

                // needs to adapt to this setting
                // if($request->hasFile('notice_file'))
                // {
                //     $file = $request->file('notice_file');
                //     $originalname = $file->getClientOriginalName();
                //     $storedFile = $file->move('notifications/documents', $originalname);
                //     $data['notice_link'] = 'notifications/documents/' . $originalname;
                //     $filePath = $storedFile->getRealPath();
                //     $data['notice_doc_type'] = pathinfo($filePath)['extension'];
                // }

                // if($request->hasFile('thumbnail_file'))
                // {
                //     $file = $request->file('thumbnail_file');
                //     $originalname = $file->getClientOriginalName();
                //     $storedFile = $file->move('notifications/thumbnails', $originalname);
                //     $data['thumbnail_link'] = 'notifications/thumbnails/' . $originalname;
                // }

                $dateFormat = 'd/m/Y H:i:s';
                $publishDate = date_create_from_format($dateFormat, $data['publish_date']);
                if (!$publishDate) {
                    $dateFormat = 'd/m/Y';
                    $publishDate = date_create_from_format($dateFormat, $data['publish_date']);
                }
                $data['publish_date'] = $publishDate;

                $data['operator_id'] = auth()->user()->id;
                $data['approver_id'] = auth()->user()->id;
                $data['approval_status'] = config('enum.approval_status.approved');
                $data['approval_date'] = Carbon::now();

                $notification = Notification::create($data);
                if($notification) {
                    foreach($tagNames as $tagName)  {
                        $tag = Tag::where('name', $tagName)->first();
                        if(!$tag) {
                            $tag = Tag::create(['name' => $tagName]);
                        }
                        $notification->tags()->attach($tag);
                    }
                }
            } catch (Exception $e) {
                report($e);
            }
        } 
        return redirect()->route('import_csv', [ 'title' => 'Import CSV File', 'file_imported' => false, ])->withSuccess('File imported successfully!');
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
            'publish_date' => 'required',
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

        // TODO: later add control for DateTime picking
        $dateFormat = 'd/m/Y H:i:s';
        $publishDate = date_create_from_format($dateFormat, $data['publish_date']);
        if (!$publishDate) {
            $dateFormat = 'd/m/Y';
            $publishDate = date_create_from_format($dateFormat, $data['publish_date']);
        }
        $data['publish_date'] = $publishDate;

        $authorityExisitsConditions = ['name' => $data['issuing_authority'],
                                        'designation' => $data['designation'],
                                        'unit_name' => $data['unit_name']];
        $authority = IssuingAuthority::where($authorityExisitsConditions)->first();
        if (!$authority) {
            $authority = IssuingAuthority::create(['name' => $data['issuing_authority'],
                                                    'designation' => $data['designation'],
                                                    'unit_name' => $data['unit_name'],
                                                    'unit_type'=> $data['unit_type']]);
        }
        $data['issuer_id'] = $authority->id;

        $regionName = $data['region_name'];
            $region = Region::where('name', $regionName)->first();
            if (!$region) {
                $region = Region::create(['name' => $regionName]);
            }
        
        $data['region_id'] = $region->id;
        $data['region_name'] = $region->name;

        $data['operator_id'] = auth()->user()->id;
        $data['approval_status'] = config('enum.approval_status.pending');

        $notification = Notification::create($data);

        if($notification) {        
            $tagNames = explode(',',$request->get('tags'));

            $tags = [];
            $index = 0;
            foreach($tagNames as $tagName)  {
                $tag = Tag::where('name', $tagName)->first();
                if(!$tag) {
                    $tag = Tag::create(['name' => $tagName]);
                }
                $tags[$index++] = $tag;
            }

            if (count($tags) > 0) {
                $notification->tags()->attach($tag);
            }
        }

        return redirect()->route('data_entry')->withSuccess('Data saved successfully!');
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
