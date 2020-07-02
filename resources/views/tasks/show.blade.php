@extends('layouts.app')

@section('content')
    <a href="/tasks" class = "btn btn-outline-secondary">Go Back</a>
    <h1>{{$task->title}}</h1>
    <div>
        {!!$task->body!!}
    </div>
    <hr>
    <small>Created: {{$task->created_at}}</small>
    <hr>
    <a href="/tasks/{{$task->id}}/edit" class="btn btn-outline-secondary">Edit</a>

    <!--Delete Button-->
    {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection
