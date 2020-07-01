@extends('layouts.app')

@section('content')
    <a href="/tasks" class = "btn btn-outline-secondary">Go Back</a>
    <h1>{{$task->title}}</h1>
    <div>
        {{$task->body}}
    </div>
    <hr>
    <small>Created: {{$task->created_at}}</small>
@endsection
