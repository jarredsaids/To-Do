@extends('layouts.app')

@section('content')
    <?php
    date_default_timezone_set('America/New_York');
    ?>
    <h1>Tasks</h1>

<!--
    loop through 2D array $tasks for display
-->
    @if (count($tasks) > 0)

        <!--Display the Tasks-->
        @foreach($tasks as $task)
            <div class="card card-body bg-light">
                @if ($task->completed == FALSE)
                    <h3>
                        <!--Toggle Complete-->
                        {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                        {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                        {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                        {!! Form::hidden('completeddate', date('Y-m-d H:i:s'),['completeddate' => 'completeddate'])!!}
                        {!! Form::hidden('completed', TRUE, ['completed' => 'completed']) !!}
                        {{Form::submit('Complete', ['class' => 'btn btn-info'])}}
                        {!!Form::close()!!}
                        <a class = "pl-3" href = "/tasks/{{$task->id}}">{{$task->title}}</a>
                    </h3>

                    <!--Show Priorities attributed to task-->
                    <table><tr>
                        @foreach(\App\PList::all() as $plist)
                            @if ($task->id == $plist->task_id)
                                @foreach(\App\Priority::all() as $priorities)
                                    @if($priorities->p_type == $plist->priority)
                                        <td class = "float-left " style = "background-color: {{$priorities->hex_color}};">
                                            {{$plist->priority}}
                                        </td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr></table>
                @else
                    <h3 style="text-decoration: line-through;">
                        <!--Toggle Complete-->
                    {!!Form::open(['action'=>['TasksController@update', $task->id], 'method' => 'PATCH', 'class' => 'float-left'])!!}
                    {!! Form::hidden('title', $task->title, ['title' => 'title']) !!}
                    {!! Form::hidden('body', $task->body, ['body' => 'body']) !!}
                    {!! Form::hidden('completed', FALSE, ['completed' => 'completed']) !!}
                    {{Form::submit('Incomplete', ['class' => 'btn btn-info'])}}
                    {!!Form::close()!!}

                        <a class = "pl-3">{{$task->title}}</a>

                    <!--Delete Button-->
                        {!!Form::open(['action'=>['TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </h3>

                    <!--Show Priorities attributed to task-->
                    <table><tr>
                            @foreach(\App\PList::all() as $plist)
                                @if ($task->id == $plist->task_id)
                                    @foreach(\App\Priority::all() as $priorities)
                                        @if($priorities->p_type == $plist->priority)
                                            <td class = "float-left " style = "background-color: {{$priorities->hex_color}};">
                                                {{$plist->priority}}
                                            </td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tr></table>
                    <small><b>Completed:</b> {{date('m/d/Y, h:i A',strtotime($task->completeddate))}}</small>
            @endif


            </div>
        @endforeach
        {{$tasks->links()}}
    @else
        <p>No Tasks found</p>
    @endif
@endsection
