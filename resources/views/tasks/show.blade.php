@extends('layouts.app')

@section('content')
    <a href="{{route('tasks.index')}}" class="btn btn-outline-secondary">Go Back</a>
    <h3>
        @if($task->isCompleted)
        {{$task->title}}
        @else
        <strike>{{$task->title}}</strike>
        @endif
        @foreach ($task->priorities as $priority)
            <div class="pull-right margin-top-lg badge priority-{{ $priority->name }} margin-y-sm"
                 style="border-radius: 0;">
                <label>
                    {{ strtoupper($priority->name) }}
                </label>

            </div>
        @endforeach
    </h3>
    <hr>

    <div class="alert alert-info">
        <form action="{{ route('tasks.destroy', $task) }}" method="post">
            <div class="pull-left">This task has been <strong>completed</strong>. Would you like to delete it?</div>
            <button type="submit" class="btn btn-outline-primary pull-right"><i class="fa fa-trash"></i> Delete</button>
            <div class="clearfix"></div>

            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </div>

    @if ($task->body)

        <div class="panel panel-default">
            <div class="panel-body">
                {{ $task->body }}
            </div>
        </div>
    @endif

    <hr>
    <p>
        <strong>Created:</strong> {{$task->created_at->format('m/d/Y, h:i A')}}
        <strong>Modified:</strong>{{$task->updated_at->format('m/d/Y, h:i A')}}
        @if($task->completed_at)
            <strong>Completed:</strong> {{date('m/d/Y, h:i A',strtotime($task->completed_at))}}
        @endif
    </p>
    <hr>
    <div class="pull-left margin-top-lg margin-y-sm">
        <a class="btn btn-default" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
    </div>
@endsection
