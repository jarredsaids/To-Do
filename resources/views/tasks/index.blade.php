@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

<!--
    loop through 2D array $tasks for display
-->
    @if (count($tasks) > 0)
        @foreach($tasks as $task)
            <div class="card card-body bg-light">
                <h3><a href = "/tasks/{{$task->id}}">{{$task->title}}</a></h3>

            </div>
        @endforeach
        {{$tasks->links()}}
    @else
        <p>No Tasks found</p>
    @endif
@endsection
