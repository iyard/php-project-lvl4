<!doctype html>
<html lang="en">
    <head>
        @include('shared.metatags')
        @include('shared.css')
        <title> @yield('title') </title>
    </head>
    <body>
        @yield('content')
        @include('shared.scripts')  
    </body>
</html>