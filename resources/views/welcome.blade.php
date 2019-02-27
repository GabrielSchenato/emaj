<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CMaterial+Icons' rel="stylesheet">
        <script src="https://cdn.bootcss.com/echarts/4.0.4/echarts-en.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

    </head>
    <body>
        <div id="app"></div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
