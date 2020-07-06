@extends('layouts.app')

@section('content')

    @auth
        <h1>Hello {{ auth()->user()->name }}</h1>
    @else
        <h1>Not logged in</h1>
    @endauth

    <form action="{{ route('tasks.store') }}" method="post" class="form-group">
        {{ csrf_field() }}
        <label for="title">Let's create a task!</label>
        <input type="text" class="form-control" name="title" id="title">

    </form>


    <h2>Pending Tasks</h2>
    <hr>

    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            Sort by...
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="?sortBy=created&sortOrder={{ $sortOrder }}">Creation
                    Date</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1"
                                       href="?sortBy=completed&sortOrder={{ $sortOrder }}">Completion Date</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="?sortBy=priority&sortOrder={{ $sortOrder }}">Priority</a>
            </li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="?sortBy=title&sortOrder={{ $sortOrder }}">Title</a>
            </li>
        </ul>
    </div>

    <!--
        loop through 2D array $tasks for display
    -->
    @forelse ($tasks as $task)

        <!--Display the Tasks-->
        <div class="panel panel-default">

            <div class="panel-body">
                <table>
                    <tr>
                        <td class="p-2 bd-highlight">
                            <h3>


                                <form action="{{ route('tasks.update', $task) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}
                                    <input type="hidden" name="completed" id="completed">
                                    <button type="submit" class="btn btn-primary d-inline"><i class="fa fa-check"></i>
                                    </button>
                                    <a class="pl-3" href="{{ route('tasks.show', $task) }}">

                                        @if ($task->isCompleted)
                                            <strike class="text-muted">{{ $task->title }}</strike>
                                        @else
                                            {{$task->title}}
                                        @endif

                                    </a>

                                    <em>{{ $task->user->name }}</em>
                                </form>

                            </h3>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @empty
        <p>No Tasks found</p>
    @endempty

    {{ $tasks->links() }}
@endsection
