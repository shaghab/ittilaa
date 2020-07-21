<!-- website home page -->

@extends('layouts.default')
@section('content')

<div class="container-fluid, page-heading row">
       <h3>CONVENIENT ACCESS TO GOVERNMENT NOTICES AND POLICIES</h3>
       <p>Don't miss out on the notices and policies that are important to you. Use Ittilaa to explore verified Government notifications.</p>
</div>

<div class="row">
  <form class="form-inline col-md-5">
     <div class="form-group search-container">
         <span class="fa fa-search form-control-icon"></span>
         <input type="text" class="form-control" placeholder="Find any public notification..." name="search">
         <button type="submit" class="btn btn-primary btn-main">Search</button>
     </div>
  </form>
</div>
<div class="row">
       <div class="col-md-5 filters">
              <div class="dropdown d-inline-block">
                     <label>Filters:</label>
                     <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Region<span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Region1</a></li>
                        <li><a href="#">Region2</a></li>
                        <li><a href="#">Region3</a></li>
                     </ul>
                     <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Ministry<span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Ministry1</a></li>
                        <li><a href="#">Ministry2</a></li>
                        <li><a href="#">Ministry3</a></li>
                     </ul>
                     <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Department<span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Department1</a></li>
                        <li><a href="#">Department2</a></li>
                        <li><a href="#">Department3</a></li>
                     </ul>
                     <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Category<span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu">
                        <li><a href="#">Category1</a></li>
                        <li><a href="#">Category2</a></li>
                        <li><a href="#">Category3</a></li>
                     </ul>
              </div>
       </div>
</div>
<div class="row">
       <div class="col-md-10 section-header">
              <h6>MOST RECENT</h6>
       </div>
</div>

@if ($count == 0)
   <div><p>No results found.</p></div>
@else

   @for ($index = 0, $row = 0; $row < $rowCount; $row++)
   <div class="row notifs">
      <div class="col-md-10 notifs-row">

         @for ($col = 0; $col < $perRow && $index < $count; $col++, $index++)
         <?php $notification = $notifications[$index]; ?>

         <div class="card col-md-2 notifs-card">
            <img class="card-img-top" src="{{ asset($notification->thumbnail_link) }}" alt="Card image">
            <div class="card-body">
               <p class="card-text">{{ $notification->publish_date }}</p>
               <h6 class="card-title">{{ $notification->title }}</h6>
            </div>
            <div class="card-img-overlay notifs-img-overlay">
               <a href="{{ route('show_notification', ['notification' => $notification->id]) }}" class="btn btn-primary btn-sm btn-main stretched-link">{{ $notification->category }}</a> 
            </div>
         </div>
         @endfor

      </div>
   </div>
   @endfor
@endif

<div class="row">
      <div class="col-md-3">
            {{ $notifications->onEachSide(1)->links() }}

            {{-- <ul class="pagination custom-pagination">
             <li class="page-item"><a class="page-link" href="#">Previous</a></li>
             <li class="page-item"><a class="page-link" href="#">1</a></li>
             <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li>
             <li class="page-item"><a class="page-link" href="#">Next</a></li>
         </ul>  --}}
      </div>
</div>
     


@endsection