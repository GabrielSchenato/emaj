<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Institucional</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('stylesheet')
</head>

<body>


        @include('layouts.menu')
        
        @yield('content')

        @include('layouts.footer')


    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}" defer></script>
    <script src="{{ asset('js/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}" defer></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('js/aos.js') }}" defer></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}" defer></script>
    <script src="{{ asset('js/scrollax.min.js') }}" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false') }}" defer></script>
    <script src="{{ asset('js/google-map.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('javascript')
</body>

</html>