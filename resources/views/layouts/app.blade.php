<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="{{asset('css/app.css')}}">
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
