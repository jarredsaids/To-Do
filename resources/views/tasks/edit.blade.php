@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <!--
        Form for creating a Task
    -->
    {!! Form::open(['action' => ['TasksController@update', $data['task']->id], 'method' => 'POST']) !!}
    <div class = "form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $data['task']->title,[ 'class' => 'form-control', 'placeholder'=> 'title' ])}}
    </div>
    <div class = "form-group">
        <b>Priorities:</b>
        @foreach($data['priorities'] as $priority)
            <span style = "background-color: {{$priority->hex_color}};">

            <!--check to see if the box should be checked-->
            {{$found = FALSE}}
            @foreach(\App\PList::all() as $plist)
                @if ($data['task']->id == $plist->task_id && $plist->priority == $priority->p_type)
                    {{$found =  " "}} <!--'TRUE' kept placing a '1' on the page-->
                @endif
            @endforeach
            @if($found == TRUE)
                {!! Form::checkbox('priority-' . $priority->p_type, $priority->p_type, TRUE ,  ['placeholder'=>'priority']) !!}
            @else
                {!! Form::checkbox('priority-' . $priority->p_type, $priority->p_type, FALSE ,  ['placeholder'=>'priority']) !!}
            @endif

                    {{Form::label('title',$priority->p_type)}}

                </span>
        @endforeach
    </div>
    <div class = "form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $data['task']->body,['id' =>'article-ckeditor', 'class' => 'form-control', 'placeholder'=> 'body text' ])}}
    </div>
    <div class = "form-group">

        {{Form::label('completed', 'Task Completed')}}

                {!! Form::checkbox('completed', TRUE, FALSE ,  ['placeholder'=>'completed']) !!}

    </div>

    {{Form::hidden('_method', 'PUT')}}  <!--spoofing a PUT request over POST-->
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
