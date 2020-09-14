<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name', 'Ittila')}}</title>
    <!-- Latest compiled and minified CSS (Bootstrap link) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- fonts used -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <link rel="stylesheet" href="{{asset('css/style.css')}}" >
</head>
<body>
<div class="container-fluid">
    {{-- <header>
      <div class="header-hr">
        <span>
           <a href="{{route("home")}}"> <img src="../images/Ittilaa Logo_001.png" alt="Ittilaa Logo"></a>
        </span>
      </div>
    </header> --}}
    <div class="container-fluid">

<!-- start of content -->
<div class="container-fluid page-heading page-banner">
   <header>
      <div class="header-hr">
        <span>
           <a href="{{route("home")}}"> <img src="../images/Ittilaa Logo_002.png" alt="Ittilaa Logo"></a>
        </span>
      </div>
    </header>
       <h3 class="text-center">CONVENIENT ACCESS TO GOVERNMENT NOTICES AND POLICIES</h3>
       <p>Don't miss out on the notices and policies that are important to you. Use Ittila to explore verified Government notifications.</p>
</div>

<div class="container-fluid search">
  <form class="form-inline col-lg-12 d-none d-lg-flex" method="POST" action="{{ route('search') }}" enctype="multipart/form-data">
   {{ csrf_field() }}

     <div class="form-group search-container">
         {{-- <span class="fa fa-search form-control-icon"></span> --}}
         <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Find any public notification..." >
         <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i>Search</button>

         @if ($errors->has('search_text'))
         <span class="help-block">
            <strong>{{ $errors->first('search_text') }}</strong>
         </span>
         @endif
     </div>
  </form>
  <form class="form-inline col-xs-12 d-flex d-lg-none" method="POST" action="{{ route('search') }}" enctype="multipart/form-data">
   {{ csrf_field() }}
   <div class="form-group search-container col">
       <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Find any public notification..." name="search">
       <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i></button>

       @if ($errors->has('search_text'))
       <span class="help-block">
          <strong>{{ $errors->first('search_text') }}</strong>
       </span>
       @endif
</form>
</div>
<div class="container filters-container">
   <div class="col filters d-none d-md-flex">
      <div class="dropdown col">
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
   <div class="col filters d-inline d-md-none">
         <label class="col">Filters</label>
         <form class="col" method="POST" action="{{ route('search_region') }}" enctype="multipart/form-data" >
         {{ csrf_field() }}
         
            <div class="dropdown region-dropdown col">
               <select id="region_id" name="region_id" class="form-control" onchange="this.form.submit()">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Region</option>

                     @foreach ($regions as $region)
                        <option class="dropdown-item" value="{{ $region->name }}">{{ $region->name }}</option>
                     </option>
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
         <form class="col" method="POST" action="{{ route('search_department') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}

            <div class="dropdown department-dropdown col">
               <select id="department" name="department" class="form-control" onchange="this.form.submit()">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Department</option>

                     @foreach ($departments as $department)
                        <option class="dropdown-item" value="{{ $department->unit_name }}">{{ $department->unit_name }}</option>
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
         <form class="col" method="POST" action="{{ route('search_category') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            
            <div class="dropdown category-dropdown col">
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
<div class="col-xs-12 section-header">
   <h6>MOST RECENT</h6>
</div>
<div class="section-results">
   @if ($notifications->count() == 0)
      <p>No results found.</p>
   @else 
      <p>showing {{ $notifications->count() }} of {{ $notifications->total() }} results</p>
</div>
   <div class="container notifs">
      <div class="col-xs-9 notifs-row">

         @for ($col = 0; $col < $notifications->count(); $col++)
         <?php $notification = $notifications[$col]; ?>

         <div class="card col-xs-7 col-sm-4 col-md-2 notifs-card">
            <img class="card-img-top" src="{{ asset('storage/'. $notification->thumbnail_link) }}" alt="Notification image">
            <div class="card-body">
               <p class="card-text caption1">{{ $notification->caption1 }}</p>
               <h6 class="card-title">{{ $notification->short_title }}</h6>
               <p class="card-text caption2">{{ $notification->caption2 }}</p>
            </div>
            <div class="card-img-overlay notifs-img-overlay">
            <a href="{{ route('show_notification', ['notification' => $notification->id]) }}" class="btn btn-primary btn-sm {{$notification->category_banner_style}} stretched-link">{{ $notification->d_cat_caption }}</a> 
            </div>
         </div>
         @endfor

      </div>
   </div>
@endif

<div class="container">
      <div class="col-xs-12">
            {{ $notifications->onEachSide(1)->links() }}
      </div>
</div>

<!-- end of content -->
    </div>
    <footer class="container-fluid">
        @include('includes.footer')
    </footer>
</div>
</body>
</html>