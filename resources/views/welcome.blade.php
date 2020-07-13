<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

{{--        Styles--}}
        <link href="{{ URL::asset('css/app.css') }}" type="text/css" rel="stylesheet">
    </head>
    <body class="bg-blue-200">
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
