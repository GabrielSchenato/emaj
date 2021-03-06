<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">    
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CMaterial+Icons' rel="stylesheet">
        <link rel="stylesheet" href="{{mix('/css/app.css')}}">
        <script src="{{ asset('js/echarts-en.min.js') }}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico" />
        <title>{{ config('app.name') }} - (Versão:. {{ config('app.version') }})</title>

    </head>
    <body>
        <div id="app"></div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
