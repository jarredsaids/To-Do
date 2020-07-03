@extends('layouts.app')

@section('content')
    <a href="/tasks" class = "btn btn-outline-secondary">Go Back</a>
    <h1>{{$task->title}}</h1>
    <div>
        {!!$task->body!!}
    </div>
    <hr>
    <small><b>Created:</b> {{$task->created_at->format('m/d/Y, h:i A')}}</small>
    @if($task->completed == TRUE)
        <small class="float-right"><b>Completed:</b> {{$task->completeddate->format('m/d/Y, h:i A')}}</small>
    @endif
    <hr>
    <a href="/tasks/{{$task->id}}/edit" class="btn btn-outline-secondary">Edit</a>

    <!--Delete Button-->
    {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection
