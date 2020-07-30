<!-- website home page -->

@extends('layouts.default')
@section('content')

<div class="container-fluid, page-heading row">
       <h3>CONVENIENT ACCESS TO GOVERNMENT NOTICES AND POLICIES</h3>
       <p>Don't miss out on the notices and policies that are important to you. Use Ittilaa to explore verified Government notifications.</p>
</div>

<div class="row">
  <form class="form-inline col-sm-6">
     <div class="form-group search-container">
         <span class="fa fa-search form-control-icon"></span>
         <input type="text" class="form-control" placeholder="Find any public notification..." name="search">
         <button type="submit" class="btn btn-primary btn-main">Search</button>
     </div>
  </form>
</div>
<div class="row">
   <div class="col-sm-6 filters">
      <div class="dropdown">
         <label class="">Filters:</label>
         <form class="" method="POST" action="{{ route('search_region') }}" enctype="multipart/form-data" >
         {{ csrf_field() }}
         
            <div class="dropdown region-dropdown">
               <select id="region_id" name="region_id" class="form-control" onchange="this.form.submit()">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Region</option>

                     @foreach ($regions as $region)
                        <option class="dropdown-item" value="{{ $region->id }}" @if ($region->id  == (int)(value('region_id'))) selected @endif>{{ $region->name }}</option>
                     @endforeach
                  </div>
               </select>

               @if ($errors->has('region_id'))
                  <span class="help-block">
                     <strong>{{ $errors->first('region_id') }}</strong>
                  </span>
               @endif
            </div>
         </form> 
         <form class="" method="POST" action="{{ route('search_department') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}

            <div class="dropdown department-dropdown">
               <select id="department" name="department" class="form-control" onchange="this.form.submit()">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Department</option>

                     @foreach ($departments as $department)
                        <option class="dropdown-item" value="{{ $department->unit_name }}" @if ($department->unit_name == value('department')) selected @endif>{{ $department->unit_name }}</option>
                     @endforeach
                  </div>
               </select>

               @if ($errors->has('department'))
                  <span class="help-block">
                     <strong>{{ $errors->first('department') }}</strong>
                  </span>
               @endif
            </div> 
         </form>
         <form class="" method="POST" action="{{ route('search_category') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            
            <div class="dropdown category-dropdown">
               <select name="category_id" class="form-control" onchange="this.form.submit()">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Category</option>

                     @foreach ($categories as $category)
                        <option class="dropdown-item" value="{{ $category['id'] }}"  @if ($category['id'] == value('category_id')) selected @endif>{{ $category['name'] }}</option>
                     @endforeach
                  </div>
               </select>

               @if ($errors->has('category_id'))
                  <span class="help-block">
                     <strong>{{ $errors->first('category_id') }}</strong>
                  </span>
               @endif
            </div>
         </form>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-sm-9 section-header">
      <h6>MOST RECENT</h6>
   </div>
</div>

@if ($count == 0)
   <div><p>No results found.</p></div>
@else

   @for ($index = 0, $row = 0; $row < config('pagination.home.number_of_rows'); $row++)
   <div class="row notifs">
      <div class="col-xs-8 notifs-row">

         @for ($col = 0; $col < config('pagination.home.records_per_row') && $index < $count; $col++, $index++)
         <?php $notification = $notifications[$index]; ?>

         <div class="card col-xs-7 col-sm-4 col-md-2 notifs-card">
            <img class="card-img-top" src="{{ asset($notification->thumbnail_link) }}" alt="Notification image">
            <div class="card-body">
               <p class="card-text">{{ $notification->caption1 }}</p>
               <h6 class="card-title">{{ $notification->short_title }}
               </h6>
               <p class="card-text">{{ $notification->caption2 }}</p>
               <p class="card-text">{{ $notification->caption3 }}</p>
            </div>
            <div class="card-img-overlay notifs-img-overlay">
               <a href="{{ route('show_notification', ['notification' => $notification->id]) }}" class="btn btn-primary btn-sm btn-main stretched-link">{{ $notification->d_cat_caption }}</a> 
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