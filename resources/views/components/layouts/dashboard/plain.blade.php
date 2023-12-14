<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ $website_name }}</title>

    <link rel="stylesheet" href="{!! asset('backend/plugins/iconfonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('backend/plugins/bootstrap/css/bootstrap.css') !!}" media="all">
    <link rel="stylesheet" href="{!! asset('backend/css/style.css') !!}" media="all">

    @isset($head)
        {{ $head }}
    @endisset
</head>

<body>

    <div class="container my-5 py-5">
        {{ $slot }}
    </div>


    @isset($foot)
        {{ $foot }}
    @endisset

</body>

</html>
