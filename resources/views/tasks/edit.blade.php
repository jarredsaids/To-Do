@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <!--
        Form for creating a Task
    -->
    {!! Form::open(['action' => ['TasksController@update', $task->id], 'method' => 'POST']) !!}
    <div class = "form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $task->title,[ 'class' => 'form-control', 'placeholder'=> 'title' ])}}

    </div>
    <div class = "form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $task->body,['id' =>'article-ckeditor', 'class' => 'form-control', 'placeholder'=> 'body text' ])}}
    </div>

    <div class = "form-group">
        <!--Loop through the priority type table for the priorities



        -->
    </div>
    {{Form::hidden('_method', 'PUT')}}  <!--spoofing a PUT request over POST-->
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
