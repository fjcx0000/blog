<!DOCTYPE html>
<html>
    <head lang="en">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="" />
        <title>@yield('title')</title>
        @section('style')
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" media="screen"/>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap-select.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/custom.css') }}" />
        @show
        @section('headscript')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="{{ URL::to('js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
        @show
    </head>
    <body>
        <div class="container">
            @if (Auth::check())
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{!empty(Auth::user()->avatar)? URL::to('images/avatar/'.Auth::user()->avatar) : URL::to('images/avatar/default.png')}}" style="width:50px;height:50px;" />
                    </a>
                    <div class="media-body">
                        <h3>Welcome to Laravel Blog, {{ Auth::user()->nickname }}</h3>
                    </div>
                </div>
            @else
            <h3>
                Welcome to Laravel Blog, please <a href="{{ URL::to('login') }}">login</a> or <a href="{{ URL::to('register') }}">Register</a>.
            </h3>
            @endif
            @include('layouts.nav')
            <div id="main_content" class="row">
                @yield('main')
            </div>
            @include('layouts.footer')
        </div>
        @section('bodyscript')
        @show
    </body>
</html>

