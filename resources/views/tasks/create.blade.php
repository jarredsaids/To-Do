@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>

<!--
    Form for creating a Task
-->
    {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '',[ 'class' => 'form-control', 'placeholder'=> 'title' ])}}

        </div>
    <div class = "form-group">
        <b>Priorities:</b>
            @foreach($data['priorities'] as $priority)
                <span style = "background-color: {{$priority->hex_color}};">
               {!! Form::checkbox($priority->p_type, $priority->p_type, FALSE , ['placeholder'=>'priority']) !!}
            {{Form::label('title',$priority->p_type)}}
                </span>
        @endforeach
    </div>

    <div class = "form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '',['id' =>'article-ckeditor', 'class' => 'form-control', 'placeholder'=> 'body text' ])}}
    </div>

    <div class = "form-group">
    <!--Loop through the priority type table for the priorities



    -->
    </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection
