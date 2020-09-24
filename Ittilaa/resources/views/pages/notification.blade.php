@extends('layouts.default')
@section('content')

<div class="container notifs-container">
   <div class="col notifs-page d-inline d-lg-flex">
      <div class="col-lg-7">
         <embed class="notif-embed" src="{{ asset('storage/'. $notification->notice_link) }}" height="100%" width="100%">
      </div>

      <div class="col-lg-5 notif-details">
         <label>{{ $notification->d_cat_caption }}</label>
         <h6>{{ $notification->title }}</h6>
         <h6>{{ $notification->region_name }}</h6>
         <p>Publishing Date: 
            {{ $notification->getPublishDate(config('enum.formats.time')) }}
         <p>
         @if (!empty($notification->caption3))
            <p>{{ $notification->caption3 }}<p>
         @endif

         <p>Tags: 
            @php
               $tags = $notification->getTags();
            @endphp
            @foreach ($tags as $tag)
               <a href="{{ route('search_tag', ['tag' => $tag->id]) }}" class="notifs-tag">{{ $tag->name }}</a>
            @endforeach
         </p>

         <p class="p-black">{{ $notification->description }}</p>
         <br>
         
         @if (!empty($notification->getSigningAuthority()))
            <p class="p-black"><b>Signing Authority:</b></p>
            <p class="p-black">{{ $notification->getSigningAuthority() }}</p> 
         @endif
         <p class="p-black"><b>Department:</b></p>
         <p class="p-black">{{ $notification->unit_name }}</p>
         <a target="_blank" href="{{ $notification->source_url }}" class="btn btn-default" role="button"><span class="fa fa-link"></span>Go to Source</a>
      </div>
   </div>
</div>

@endsection