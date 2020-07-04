<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="{{asset('css/app.css')}}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <title>{{config('app.name', 'To-Do')}}</title>

</head>
<body>
    @include('inc.navbar')
    <div class ="container ">
        @include('inc.messages')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script> setTimeout(function(){ CKEDITOR.replace( 'article-ckeditor' ); },400); </script>`
</body>
</html>
