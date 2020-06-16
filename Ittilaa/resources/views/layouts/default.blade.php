<!-- for main layout of website. 
    I have created this layout structure by refering:
    https://www.cloudways.com/blog/create-laravel-blade-layout/-->

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
        @yield('content')
    </div>
    <footer class="container-fluid">
        @include('includes.footer')
    </footer>
</div>
</body>
</html>