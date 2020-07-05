@extends('layouts.app')

@section('content')

    @auth
        <h1>Hello {{ auth()->user()->name }}</h1>
    @else
        <h1>Not logged in</h1>
    @endauth

    <h1>Pending Tasks</h1>
    <hr>

    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            Sort by...
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Creation Date</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Completion Date</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Deletion Date</a></li>
        </ul>
    </div>

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
                        <a class="pl-3" href="/tasks/{{$task->id}}">{{$task->title}}</a>
                        <em>{{ $task->user->name }}</em>
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

                        <a class="pl-3" href="/tasks/{{$task->id}}">{{$task->title}}</a>

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

{{--        {{$tasks->links()}}--}}
    @else
        <p>No Tasks found</p>
    @endif
@endsection
