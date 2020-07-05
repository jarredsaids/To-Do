@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome to WolfTask!</h1>
        <p>This is the #1 rated task management and prioritization application!</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('tasks.index') }}" roles="button">Manage Tasks</a></p>
    </div>
@endsection
