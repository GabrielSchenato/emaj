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

    <link rel="stylesheet" href="{{mix('/css/institucional.css')}}">

    @yield('stylesheet')
</head>

<body>

        @include('layouts.loader')
        @include('layouts.menu')
        
        @yield('content')

        @include('layouts.footer')


    <!-- Scripts -->
    <script src="{{ mix('/js/institucional.js') }}"></script>

    @yield('javascript')
</body>

</html>