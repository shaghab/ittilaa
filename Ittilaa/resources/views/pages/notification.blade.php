@extends('layouts.default')
@section('content')

<div class="container notifs-container">
   <div class="col notifs-page d-inline d-lg-flex">
      <div class="col-lg-7">
         <embed class="notif-embed" src="{{ asset($notification->notice_link) }}" height="100%" width="100%">
      </div>

      <div class="col-lg-5 notif-details">
         <label>Notification</label>
         <h6>{{ $notification->title }}</h6>
         <h6>{{ $notification->region_name }}</h6>
         <p>Publishing Date: {{ $notification->publish_date }}<p>

         <p>Tags: 
            @php
               $tags = $notification->getTags();
            @endphp
            @foreach ($tags as $tag)
               <a href="{{ route('search_tag', ['tag' => $tag->id]) }}" class="notifs-tag">{{ $tag->name }};</a>
            @endforeach
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