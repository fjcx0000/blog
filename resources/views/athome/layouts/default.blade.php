<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8"/>
        <title>Athomes</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" media="screen"/>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap-select.min.css') }}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
    <div class="container">
        <div class="row">
            @yield('main')
        </div>
    </div>

    <script src="{{ URL::to('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('js/bootstrap-select.min.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker();
    </script>
    </body>
</html>

