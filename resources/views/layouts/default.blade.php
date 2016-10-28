<!DOCTYPE html>
<html>
    <head lang="en">
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="" />
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" media="screen"/>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap-select.min.css') }}" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="{{ URL::to('js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
    </head>
    <body>
        <div class="container">
            <h1>
                <a href="/">ShiYanLou Blog</a>
            </h1>
            @include('layouts.nav')
            <div id="content" class="row">
                @yield('main')
            </div>
            @include('layouts.footer')
        </div>
    </body>
</html>

