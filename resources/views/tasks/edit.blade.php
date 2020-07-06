@extends('layouts.app')

@section('content')
    <a href="{{route('tasks.show', $task)}}" class="btn btn-outline-secondary">Go Back</a>
    <form action="{{ route('tasks.update', $task->id) }}" method="post">

        <h1>Edit Task
            @foreach ($priorities as $priority)
                {{ $task->priorities->has($priority->id) }}
                <div class="pull-right margin-top-lg badge priority-{{ $priority->name }} margin-y-sm"
                     style="border-radius: 0;">
                    <label>
                        <input type="checkbox"
                               {{ $task->priorities->contains($priority->id) ? "checked=checked" : null }}
                               name="priorities[]" value="{{ $priority->id }}">
                        {{ strtoupper($priority->name) }}
                    </label>

                </div>
            @endforeach
        </h1>


        {{ method_field('patch') }}
        {{ csrf_field() }}

        <div class="row margin-x-lg">
            <input class="form-control" type="text" name="title" id="title" value="{{ $task->title }}">
        </div>

        <textarea name="body" id="body" cols="30" rows="10"
                  class="form-control" placeholder="Body of task (optional)">{{ $task->body }}</textarea>

        <button type="submit" class="btn btn-default margin-top-md pull-right">Update task</button>

    </form>

@endsection
