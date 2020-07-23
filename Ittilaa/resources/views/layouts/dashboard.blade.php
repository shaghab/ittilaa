<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container-fluid">
    <header>
        @include('includes.header')
    </header>
    <div class="container-fluid">
      <div class="container-fluid row">
         <div class="col-md-3">
            @include('includes.side_panel')
         </div>
         <div class="col-md-8">
            @yield('content')
         </div>
      </div>
   </div>
   <footer class="container-fluid">
      @include('includes.footer')
   </footer>
</div>
</body>
</html>