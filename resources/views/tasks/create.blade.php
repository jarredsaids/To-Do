@extends('layouts.app')

@section('content')
    <form action="{{route('tasks.store')}}" method="post">
    <h1>Create Task
    @foreach ($priorities as $priority)
        <div class="pull-right margin-top-lg badge priority-{{ $priority->name }} margin-y-sm"
             style="border-radius: 0;">
            <label>
                <input type="checkbox"
                       {{ (!$priority->id) ? "checked=checked" : null }}
                       name="priorities[]" value="{{ $priority->id }}">
                {{ strtoupper($priority->name) }}
            </label>

        </div>
    @endforeach
    </h1>

    <!--
        Form for creating a Task
    -->
    <div class="row margin-x-lg">
        <input class="form-control" placeholder = "Title of Task" type="text" name="title" id="title" value="">
    </div>

    <textarea name="body" id="body" cols="30" rows="10"
              class="form-control" placeholder="Body of task (optional)"></textarea>


    <button type="submit" class="btn btn-default margin-top-md pull-right">Create</button>
    {{ csrf_field() }}
    </form>

@endsection
