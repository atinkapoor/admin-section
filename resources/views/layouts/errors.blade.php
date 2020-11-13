<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>
    <!-- core CSS -->
    <link href="{{ asset('css/website/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/slick-theme.css') }}">
    <link href="{{ asset('css/website/main.css?v=1') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/respond.min.js') }}" type="text/javascript"></script>
    <![endif]-->
</head>
<!--/head-->
<body>
<div class="error_col">
    <div class="hed404">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('home')}}" class="">
                        <img src="{{ asset('images/website/60logo.svg') }}" class="logoicon">
                    </a>
                </div>
                <div class="col-md-6 text-right">
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</div>
</body>
</html>