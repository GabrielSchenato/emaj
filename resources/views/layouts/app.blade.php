<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Institucional - @yield('title')</title>

    <!-- Styles -->

    <link rel="stylesheet" href="{{mix('/css/all.css')}}">

    @yield('stylesheet')
</head>

<body>

        @include('layouts.loader')
        @include('layouts.menu')
        
        @yield('content')

        @include('layouts.footer')


    <!-- Scripts -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false') }}" defer></script> -->
    <script src="{{ mix('/js/all.js') }}"></script>

    @yield('javascript')
</body>

</html>