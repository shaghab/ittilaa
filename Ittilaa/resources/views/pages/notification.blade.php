@extends('layouts.default')
@section('content')

<div class="container-fluid row">
   <div class="col-md-10 notifs-page">
      <div class="col-md-7">
         <embed class="notif-embed" src="{{ asset($notification->notice_link) }}" height="100%" width="100%">
      </div>

      <div class="col-md-5 notif-details">
         <label>Notification</label>
         <h6>{{ $notification->title }}</h6>
         <h6>{{ $notification->region_name }}</h6>
         <p>Publishing Date: {{ $notification->publish_date }}<p>

         <p>Tags: Tag1, Tag2, Tag3, Tag4, Tag5 
            <!-- @php
               $tags = $notification->getTags();
            @endphp
            @foreach ($tags as $tag)
               <a href=#>{{ $tag->name }}</a>
            @endforeach -->
         </p>

         <p class="p-black">{{ $notification->description }}</p>
         <br>
         <p class="p-black"><b>Signing Authority:</b></p>
         <p class="p-black">{{ $notification->issuing_authority.', '. $notification->designation}}</p> 
         <p class="p-black"><b>Department:</b></p>
         <p class="p-black">{{ $notification->unit_name }}</p>
         <a href="{{ $notification->source_url }}" class="btn btn-default" role="button"><i class="fa fa-link"></i>Go to Source</a>
      </div>
   </div>
</div>

@endsection