<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.ncsu.edu/brand-assets/bootstrap/css/bootstrap.min.css">
    {{--<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">--}}
    <title>{{config('app.name', 'To-Do')}}</title>

</head>
<body>
    @include('inc.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdn.ncsu.edu/brand-assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
