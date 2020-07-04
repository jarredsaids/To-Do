@extends('layouts.app')

@section('content')
    <?php
    date_default_timezone_set('America/New_York');
    ?>

    <h1>Tasks

    <!-- Sort By button -->
        <div class="btn-group float-right">
            <button type="button" class="btn btn-secondary">Sort by...</button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/index">Completion Status</a>
                <a class="dropdown-item" href="#">Creation Time</a>
                <a class="dropdown-item" href="#">Alphabetical</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Priority Type:</a>
            </div>
        </div>
    </h1>

<!--
    loop through 2D array $tasks for display
-->
    @if (count($tasks) > 0)

        <!--Display the Tasks-->
        @foreach($tasks as $task)
            <div class="card card-body bg-light">




                @if (!$task->completed_at)
                    <h3>
                        <!--Toggle Complete-->
                        {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                        {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                        {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                        {!! Form::hidden('completed_at', date('Y-m-d H:i:s'),['completed_at' => 'completed_at'])!!}
                        {!! Form::hidden('completed', TRUE, ['completed' => 'completed']) !!}
                        {{Form::submit('Complete', ['class' => 'btn btn-info'])}}
                        {!!Form::close()!!}
                        <a class = "pl-3" href = "/tasks/{{$task->id}}">{{$task->title}}</a>
                    </h3>
                @else
                    <h3 style="text-decoration: line-through;">
                        <!--Toggle Complete-->
                    {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                    {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                    {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                    {!! Form::hidden('completed', FALSE, ['completed' => 'completed']) !!}
                    {{Form::submit('Incomplete', ['class' => 'btn btn-info'])}}
                    {!!Form::close()!!}

                        <a class = "pl-3" href = "/tasks/{{$task->id}}">{{$task->title}}</a>

                    <!--Delete Button-->
                        {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </h3>

                    <small><b>Completed:</b> {{date('m/d/Y, h:i A',strtotime($task->completed_at))}}</small>
            @endif


            </div>
        @endforeach
        {{$tasks->links()}}
    @else
        <p>No Tasks found</p>
    @endif
@endsection
