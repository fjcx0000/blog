<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">James Blog</a>
    </div>
    <div id="navbar-menu" class="collapse navbar-collapse">
        @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('home') }}">Home</a></li>
                @if ( Auth::user()->is_admin )
                    <li class=""><a href="{{ URL::to('admin/users') }}"> Users</a></li>
                    <li class="{{ (isset($page) and ($page == 'articles')) ? 'active' : '' }}"><a href="{{ URL::to('admin/articles') }}"> Articles</a></li>
                    <li class="{{ (isset($page) and ($page == 'tags')) ? 'active' : '' }}"><a href="{{ URL::to('admin/tags') }}">Tags</a> </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li >
                    <a href="{{ URL::to('user/'.Auth::id().'/articles') }}"><span class="glyphicon glyphicon-list-alt"></span> My Article</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-home"></span> {{ Request::user()->nickname}}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::to('article/create') }}"><span class="glyphicon glyphicon-pencil"></span> Publish Article</a></li>
                        <li><a href="{{ URL::to('user/'.Auth::id().'/edit') }}"><span class="glyphicon glyphicon-user"></span> Information</a></li>
                        <li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
                    </ul>
                </li>
            </ul>
        @else
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ URL::to('register') }}" ><span class="glyphicon glyphicon-registration-mark"></span>Register</a>
                </li>
                <li>
                    <a href="{{ URL::to('login') }}" ><span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
            </ul>
        @endif
    </div>
</nav>