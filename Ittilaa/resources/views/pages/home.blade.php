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

    <script type="text/javascript">
      function regionSelected(region){
        document.getElementById("region_filter").value = region;
        document.getElementById("search_form").submit();
      }

      function unitSelected(unit){
        document.getElementById("department_filter").value = unit;
        document.getElementById("search_form").submit();
      }

      function categorySelected(cat){
        document.getElementById("category_filter").value = cat;
        document.getElementById("search_form").submit();
      }

      function regionSelected_m(region){
        document.getElementById("region_filter_m").value = region;
        document.getElementById("search_form_m").submit();
      }

      function unitSelected_m(unit){
        document.getElementById("department_filter_m").value = unit;
        document.getElementById("search_form_m").submit();
      }

      function categorySelected_m(cat){
        document.getElementById("category_filter_m").value = cat;
        document.getElementById("search_form_m").submit();
      }

      function removeRegionFilter(){
        document.getElementById("region_filter").value = "";
        document.getElementById("search_form").submit();
      }

      function removeUnitFilter(){
        document.getElementById("department_filter").value = "";
        document.getElementById("search_form").submit();
      }

      function removeCategoryFilter(){
        document.getElementById("category_filter").value = "";
        document.getElementById("search_form").submit();
      }

      function removeRegionFilter_m(){
        document.getElementById("region_filter_m").value = "";
        document.getElementById("search_form_m").submit();
      }

      function removeUnitFilter_m(){
        document.getElementById("department_filter_m").value = "";
        document.getElementById("search_form_m").submit();
      }

      function removeCategoryFilter_m(){
        document.getElementById("category_filter_m").value = "";
        document.getElementById("search_form_m").submit();
      }
    </script>
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
       <p>Don't miss out on the notices and policies that are important to you. Use ittila to explore verified Government notifications.</p>
</div>

<div class="container-fluid search">
  <form id="search_form" name="search_form" class="form-inline col-lg-12 d-none d-lg-flex" method="POST" action="{{ route('search') }}" enctype="multipart/form-data">
   {{ csrf_field() }}

     <div class="form-group search-container">
         {{-- <span class="fa fa-search form-control-icon"></span> --}}
         <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Find any public notification..." value="{{$filters['search_text']}}" >

         <input type="hidden" id="region_filter" name="region_filter" value="{{$filters['region_filter']}}" />
         <input type="hidden" id="department_filter" name="department_filter" value="{{$filters['department_filter']}}" />
         <input type="hidden" id="category_filter" name="category_filter" value="{{$filters['category_filter']}}" />

         <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i>Search</button>

         @if ($errors->has('search_text'))
         <span class="help-block">
            <strong>{{ $errors->first('search_text') }}</strong>
         </span>
         @endif
     </div>
  </form>
  <form id="search_form_m" name="search_form" class="form-inline col-xs-12 d-flex d-lg-none" method="POST" action="{{ route('search') }}" enctype="multipart/form-data">
   {{ csrf_field() }}

   <div class="form-group search-container col">
       <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Find any public notification..." value="{{$filters['search_text']}}">

       <input type="hidden" id="region_filter_m" name="region_filter" value="{{$filters['region_filter']}}" />
       <input type="hidden" id="department_filter_m" name="department_filter" value="{{$filters['department_filter']}}" />
       <input type="hidden" id="category_filter_m" name="category_filter" value="{{$filters['category_filter']}}" />

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
         <form class="" enctype="multipart/form-data" >
            <div class="dropdown region-dropdown">
               <select id="region_id" name="region_id" class="form-control" onchange="regionSelected(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Region</option>

                     @foreach ($regions as $region)
                        <option class="dropdown-item" value="{{ $region->name }}" >{{ $region->name }}</option>
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
         <form class="" enctype="multipart/form-data" >
            <div class="dropdown department-dropdown">
               <select id="department" name="department" class="form-control" onchange="unitSelected(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Department</option>

                     @foreach ($departments as $department)
                        <option class="dropdown-item" value="{{ $department->unit_name }}" >{{ $department->unit_name }}</option>
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
         <form class="" enctype="multipart/form-data" >
            <div class="dropdown category-dropdown">
               <select id="category_id" name="category_id" class="form-control" onchange="categorySelected(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Category</option>

                     @foreach ($categories as $category)
                        <option class="dropdown-item" value="{{ $category['id'] }}" >{{ $category['name'] }}</option>
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
         <form class="col" enctype="multipart/form-data" >
            <div class="dropdown region-dropdown col">
               <select id="region_id" name="region_id" class="form-control" onchange="regionSelected_m(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Region</option>

                     @foreach ($regions as $region)
                        <option class="dropdown-item" value="{{ $region->name }}" >{{ $region->name }}</option>
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
         <form class="col" enctype="multipart/form-data" >
            <div class="dropdown department-dropdown col">
               <select id="department" name="department" class="form-control" onchange="unitSelected_m(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Department</option>

                     @foreach ($departments as $department)
                        <option class="dropdown-item" value="{{ $department->unit_name }}" >{{ $department->unit_name }}</option>
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
         <form class="col" enctype="multipart/form-data" >            
            <div class="dropdown category-dropdown col">
               <select id="category_id" name="category_id" class="form-control" onchange="categorySelected_m(this.value)">
                  <div class="dropdown-menu">
                     <option class="dropdown-item" value="">Category</option>

                     @foreach ($categories as $category)
                        <option class="dropdown-item" value="{{ $category['id'] }}" >{{ $category['name'] }}</option>
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
<div class="container filter-tags-container">
  <div>
    <ul style="list-style-type:none">
      <li style="float:left">
        <span name="region_tag" 
              style="display: <?php if(!empty($filters['region_filter'])) echo('block'); else echo('none'); ?>">

          {{ $filters['region_filter'] }}
          <span onclick="removeRegionFilter()" style="color:red" >x</span>
        </span>
      </li>
      <li style="float:left">
        <span name="unit_tag" 
              style="display: <?php if(!empty($filters['department_filter'])) echo('block'); else echo('none'); ?>">

          {{ $filters['department_filter'] }}
          <span onclick="removeUnitFilter()" style="color:red" >x</span>
        </span>
      </li>
      <li style="float:left">
        <span name="category_tag" 
              style="display: <?php if(!empty($filters['category_filter'])) echo('block'); else echo('none'); ?>">
          
          {{ $filters['category_filter'] }}
          <span onclick="removeCategoryFilter()" style="color:red" >x</span>
        </span>
      </li>
    </ul>
  </div>
<!--   TODO: Myra check if you need a separate version for mobile devices and uncomment this section otherwise delete it -->
<!-- 
  <div>
    <ul style="list-style-type:none">
      <li style="float:left">
        <span name="region_tag_m" 
              style="display: <?php if(!empty($filters['region_filter'])) echo('block'); else echo('none'); ?>">

          {{ $filters['region_filter'] }}
          <span onclick="removeRegionFilter_m()" style="color:red" >x</span>
        </span>
      </li>
      <li style="float:left">
        <span name="unit_tag_m" 
              style="display: <?php if(!empty($filters['department_filter'])) echo('block'); else echo('none'); ?>">

          {{ $filters['department_filter'] }}
          <span onclick="removeUnitFilter_m()" style="color:red" >x</span>
        </span>
      </li>
      <li style="float:left">
        <span name="category_tag_m" 
              style="display: <?php if(!empty($filters['category_filter'])) echo('block'); else echo('none'); ?>">
          
          {{ $filters['category_filter'] }}
          <span onclick="removeCategoryFilter_m()" style="color:red" >x</span>
        </span>
      </li>
    </ul>
  </div> -->
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