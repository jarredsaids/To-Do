@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

<!--
    loop through 2D array $tasks for display
-->
    @if (count($tasks) > 0)
        @foreach($tasks as $task)
            <div class="card card-body bg-light">
                @if ($task->completed == FALSE)
                    <h3>
                        <!--Toggle Complete-->
                        {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                        {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                        {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                        {!! Form::hidden('completed', TRUE, ['completed' => 'completed']) !!}
                        {{Form::submit('Complete', ['class' => 'btn btn-info'])}}
                        {!!Form::close()!!}
                        <a href = "/tasks/{{$task->id}}">{{$task->title}}</a>
                    </h3>
                @else
                    <h3 style="text-decoration: line-through;" >
                        <!--Toggle Complete-->
                    {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                    {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                    {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                    {!! Form::hidden('completed', FALSE, ['completed' => 'completed']) !!}
                    {{Form::submit('Complete', ['class' => 'btn btn-info'])}}
                    {!!Form::close()!!}

                    {{$task->title}}

                    <!--Delete Button-->
                        {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </h3>
            @endif


            </div>
        @endforeach
        {{$tasks->links()}}
    @else
        <p>No Tasks found</p>
    @endif
@endsection
