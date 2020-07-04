@extends('layouts.app')

@section('content')
    <a href="/tasks" class = "btn btn-outline-secondary">Go Back</a>
    @if($task->completed == FALSE)
        <h1 >{{$task->title}}</h1>
    @else
        <h1 style="text-decoration: line-through;">{{$task->title}}</h1>
    @endif

    <!--Show Priorities attributed to task-->
{{--    <table><tr>--}}
{{--            @foreach(\App\PList::all() as $plist)--}}
{{--                @if ($task->id == $plist->task_id)--}}
{{--                    @foreach(\App\Priority::all() as $priorities)--}}
{{--                        @if($priorities->p_type == $plist->priority)--}}
{{--                            <td class = "float-left " style = "background-color: {{$priorities->hex_color}};">--}}
{{--                                {{$plist->priority}}--}}
{{--                            </td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </tr></table>--}}

    <div>
        {!!$task->body!!}
    </div>

    <hr>
    <table style ="width: 100%;"<tr>
        <td><small><b>Created:</b> {{$task->created_at->format('m/d/Y, h:i A')}}</small></td>
        <td><small><b>Modified:</b>{{$task->updated_at->format('m/d/Y, h:i A')}}</small></td>

        @if($task->completed == TRUE)
            <td><small><b>Completed:</b> {{date('m/d/Y, h:i A',strtotime($task->completed_at))}}</small></td>
         @else
           <td><small><b>Completed:</b></small></td>
         @endif
        </tr></table>
    <hr>
    <a href="/tasks/{{$task->id}}/edit" class="btn btn-outline-secondary">Edit</a>

    <!--Delete Button-->
    {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection
