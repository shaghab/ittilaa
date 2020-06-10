<!-- for main layout of website. 
    I have created this layout structure by refering:
    https://www.cloudways.com/blog/create-laravel-blade-layout/
-->

<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">
    <header class="row">
        @include('includes.header')
    </header>
    <div id="main" class="row">
        <!--@yield('content')-->
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</div>
</body>
</html>