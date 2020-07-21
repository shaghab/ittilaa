    <!doctype html>
    <html>
    <head>
        @include('includes.head')
    </head>
    <body>
    <div class="container-fluid">
        <header>
            @include('includes.logo')
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