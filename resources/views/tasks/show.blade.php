@extends('layouts.app')

@section('content')
    <a href="{{route('tasks.index')}}" class="btn btn-outline-secondary">Go Back</a>
    @if($task->completed == FALSE)
        <h1>{{$task->title}}
            @else
                <h1 style="text-decoration: line-through;">{{$task->title}}
                    @endif

                    @foreach ($task->priorities as $priority)
                        <div class="pull-right margin-top-lg badge priority-{{ $priority->name }} margin-y-sm"
                             style="border-radius: 0;">
                            <label>
                                {{ strtoupper($priority->name) }}
                            </label>

                        </div>
                    @endforeach
                </h1>

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
                <div class="pull-left margin-top-lg margin-y-sm"><a class="btn btn-default"
                                                                    href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                </div>
                <div class="pull-left margin-top-lg margin-y-sm">
                    <form action="">
                        <button type="submit" class="btn btn-danger" href="{{ route('tasks.destroy', $task->id) }}">
                            Delete
                        </button>
                    </form>
                </div>

        {{ method_field('DELETE') }}
@endsection
