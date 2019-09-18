<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('shared.metatags')
    @include('shared.scripts')
    @include('shared.fonts')
    @include('shared.styles')
    <title> 
        @yield('title') 
    </title>
</head>
<body>
    <div id="app">
        @include('shared.headNavBar')
        <main class="py-4" style="margin: 50px">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
