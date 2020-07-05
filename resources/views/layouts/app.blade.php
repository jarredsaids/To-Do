<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.ncsu.edu/brand-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>{{ config('app.name') }}</title>

</head>
<body>
    @include('includes.navbar')

    <div class="container" style="margin-top:75px;">
        @include('includes.messages')

        @yield('content')
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdn.ncsu.edu/brand-assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
