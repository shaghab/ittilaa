@extends('layouts.default')
@section('content')

<div class="container-fluid row">
   <div class="col-md-10 notifs-page">
      {{-- @if ($notification->notice_doc_type == "IMAGE") --}}
      <div class="col-md-7">
         <embed class="notif-embed" src="{{ asset($notification->notice_link) }}" height="100%" width="100%">
      </div>
      {{-- @else
      <div class="notif-embed embed-responsive embed-responsive-1by1">
         <iframe class="embed-responsive-item" src="../images/notif.pdf" allowfullscreen></iframe>
      </div>
      @endif --}}

      <div class="col-md-5 notif-details">
         <label>Notification</label>
         <h6>{{ $notification->title }}</h6>
         <h6>{{ $notification->region_name }}</h6>
         <p>Publishing Date: {{ $notification->publish_date }}<p>
         <p class="p-black">{{ $notification->description }}</p>
         <br>
         <p class="p-black"><b>Signing Authority:</b></p>
         <p class="p-black">{{ $notification->signing_authority }}</p> 
         <p class="p-black"><b>Ministry / Division:</b></p>
         <p class="p-black">{{ $notification->ministry_name }} / {{ $notification->division_name }}</p>
         <p class="p-black"><b>Source:</b></p>
         <p class="p-black">{{ $notification->notifier }}, {{ $notification->notifier_designation }}</p>
         <a href="{{ $notification->source_url }}" class="btn btn-default" role="button"><i class="fa fa-link"></i>Go to Source</a>
      </div>
   </div>
</div>

@endsection