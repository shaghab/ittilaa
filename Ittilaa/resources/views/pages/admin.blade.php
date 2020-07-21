
@extends('layouts.default')

@section('content')

<!-- add HTML related to login here -->
<div class="container-fluid row">
   <div class="col-md-3">
      <div class="sidenav">
         <a href="{{ route('pending') }}">Pending Notifications</a>
         <a href="{{ route('approved') }}">Approved Notifications</a>
         <a href="{{ route('rejected') }}">Rejected Notifications</a>
         <a href="{{ route('data_entry') }}">Data Entry View</a>
      </div>
   </div>
   <div class="col-md-8">
      <div class="row page-heading">
         <h3>
            @switch($tab)
               @case('pending')
                  Pending Notifications
                  @break
               @case('approved')
                  Approved Notifications
                  @break
               @case('rejected')
                  Rejected Notifications
                  @break
               @default
                  Pending Notifications
            @endswitch
         </h3>
      </div>
      @if ($count == 0)
         <div><p>
            @switch($tab)
               @case('pending')
                  No pending notifications.
                  @break
               @case('approved')
                  No approved notifications.
                  @break
               @case('rejected')
                  No rejected notifications.
                  @break
               @default
                  No pending notifications.
            @endswitch
         </p></div>
      @else

         @for ($index = 0; $index < $count; $index++)
         <?php $notification = $notifications[$index]; ?>

         <div class="row admin-notifs">
            <div class="card admin-card col-md-12">
               <div class="col-md-2">
                  <a href="{{ route('show_notification', ['notification' => $notification->id]) }}">
                     <img class="card-img-top" src="{{ asset($notification->thumbnail_link) }}" alt="Card image">
                  </a>
               </div>
               <div class="card-body admin-card-body col-md-9">
                  <h4 class="card-title">{{ $notification->title }}</h4>
                  <p class="card-text">Date: {{ $notification->publish_date }}</p>
                  <p class="card-text">Tags:
                     {{-- @php
                        $tags = $notification->getTags();
                     @endphp
                     @foreach ($tags as $tag)
                        {{ $tag->name }}
                     @endforeach  --}}
                     {{-- Tag1, Tag2, Tag3, Tag4, Tag5 --}}
                  </p>
                  <p class="card-text">Department: {{ $notification->division_name }}</p>

                  @if ($tab == 'pending')
                     <a href="{{ route('approve_notification', ['notification' => $notification->id]) }}" class="btn btn-success btn-accept">Approve</a>
                     <a href="{{ route('reject_notification', ['notification' => $notification->id]) }}" class="btn btn-danger btn-reject">Reject</a>
                  @endif
               </div>
            </div>
         </div>

         @endfor
      @endif

   </div>
</div>

<div class="row">
   <div class="col-md-3">

      {{ $notifications->onEachSide(1)->links() }}

      {{-- <ul class="pagination custom-pagination">
         <li class="page-item"><a class="page-link" href="#">Previous</a></li>
         <li class="page-item"><a class="page-link" href="#">1</a></li>
         <li class="page-item"><a class="page-link" href="#">2</a></li>
         <li class="page-item"><a class="page-link" href="#">3</a></li>
         <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul> --}} 
   </div>
</div>

@endsection
