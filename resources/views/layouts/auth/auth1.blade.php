<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="icon" href="{!! asset('images/logo.png') !!}" type="image/x-icon">
    <link rel="stylesheet" href="{!! asset('backend/plugins/bootstrap/css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/plugins.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/css/animated.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/feather/feather.css') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>

<body class="">
    <div class="page login-bg">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-lg-5">
                                <div class="card">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{!! asset('backend/plugins/jquery/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap/js/popper.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap/js/bootstrap.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/sticky.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/themeColors.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/custom.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/plugins/bootstrap-notify/bootstrap-notify.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.validate.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/jquery.form.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('backend/js/functions.js') !!}"></script>
    @yield('foot')
</body>

</html>
