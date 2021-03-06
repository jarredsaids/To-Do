<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ is_active(['/']) }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="{{ is_active(['about']) }}"><a href="{{ route('about') }}">About</a></li>
                <li class="{{ is_active(['tasks', 'tasks/*']) }}"><a href="{{ route('tasks.index') }}">Tasks</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('tasks.create') }}">
                        New Task
                    </a>
                </li>
                <li>
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link login-link">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('google.login') }}">
                            Login With Google <i class="fa fa-google"></i>
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
