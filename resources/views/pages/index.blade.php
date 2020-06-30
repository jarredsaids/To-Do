@extends('layouts.app')

@section('content')
    <div class = "jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This the #1 rated task making and prioritizing program.</p>
        <p><a class="btn btn-primary btn-lg" href="/tasks" roles="button">View Tasks</a></p>
    </div>
@endsection
