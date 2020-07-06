@extends('layouts.app')

@section('content')

    <form action="{{ route('tasks.store') }}" method="post" class="form-group">
        {{ csrf_field() }}
        <label for="title">Let's create a task!</label>
        <input type="text" class="form-control" name="title" id="title">

    </form>

    <hr>

    <div class="text-center">
        @if (request()->route('priority'))
            Priority: <span class="badge">{{ strtoupper(request()->route('priority')) }}</span>
        @endif
        @if(request()->query('sortBy'))
            Sort by: <span class="badge">{{ ucwords(request()->query('sortBy')) }} {{ strtoupper($sortOrder) ?? 'null' }}</span>
        @endif
    </div>

    <div class="dropdown margin-x-md pull-left">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            <i class="fa fa-sort"></i> Sort tasks by...
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="?sortBy=created&sortOrder={{ $sortOrder }}">
                    Creation Date
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" tabindex="-1"
                   href="?sortBy=completed&sortOrder={{ $sortOrder }}">
                    Completion Date
                </a></li>
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="?sortBy=title&sortOrder={{ $sortOrder }}">
                    Title
                </a>
            </li>
        </ul>
    </div>

    <div class="dropdown margin-x-md pull-right">
        <button class="btn dropdown-toggle" type="button" id="filterMenu" data-toggle="dropdown">
            <i class="fa fa-filter"></i> Filter by Priority
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

            <!--Looping through Priorities Table for priority search options-->
            @foreach (\App\Priority::all() as $priority)
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="{{ route('tasks.index') }}/filter-by/{{ $priority->name }}">
                        {{ ucwords($priority->name )}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="clearfix"></div>

    <!--
        loop through 2D array $tasks for display
    -->
    @forelse ($tasks as $task)

        <!--Display the Tasks-->
        <div class="panel panel-default bg-secondary">

            <div class="panel-body">
                <table style="width: 100%;">
                    <tr style="width: 100%;">
                        <td class="p-2 bd-highlight">
                            <h3>
                                <form action="{{ route('tasks.update', $task) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}
                                    <input type="hidden" name="completed" id="completed">
                                    @if ($task->isCompleted)
                                        <button type="submit" class="btn btn-outline-secondary d-inline"><i
                                                class="fa fa-times"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary d-inline"><i
                                                class="fa fa-check"></i>
                                        </button>
                                    @endif
                                    <a class="pl-3" href="{{ route('tasks.show', $task) }}">

                                        @if ($task->isCompleted)
                                            <strike class="text-muted">{{ $task->title }}</strike>
                                        @else
                                            {{$task->title}}
                                        @endif

                                    </a>
                                </form>

                            </h3>
                        </td>
                        <td class="text-right">
                            <div class="clearfix">
                                @foreach($task->priorities as $priority)
                                    @include('includes.priority-badge')
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @empty
        <p>No Tasks found</p>
    @endforelse

    {{ $tasks->links() }}
@endsection
