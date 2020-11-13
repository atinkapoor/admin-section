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
    <title>Solo60® | @yield('title')</title>
    <!-- core CSS -->
    <link href="{{ asset('css/website/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/website/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/slick-theme.css') }}">
    <link href="{{ asset('css/website/main.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/respond.min.js') }}" type="text/javascript"></script>
    <![endif]-->
</head>
<!--/head-->
<body>
@yield('content')
@include('partials.footer')
{!! $pixel['google_analytics'] !!}
{!! $pixel['facebook_pixel'] !!}
@if($cookie_warning_msg['cookie_show'])
    <div id="cookie-law-info-bar"
         style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0); bottom: 0px; position: fixed; display: none;">
        <div class="btns cookie">
            <p>
                {{$cookie_warning_msg['cookies_warning_text']}}
                <a onclick="cookieDismiss();" class="btn_l"
                   style="display: inline-block; margin: 5px;">ACCEPT</a>
            </p>
        </div>
    </div>
    <script>
        function cookieDismiss() {
            setCookie('cookieDismiss', '1', 7);
            $("#cookie-law-info-bar").hide();
        }
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        function cookieConsent() {
            if (!getCookie('cookieDismiss')) {
                $("#cookie-law-info-bar").show();
            }
        }
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0)return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        window.onload = function () {
            cookieConsent();
        };
    </script>
@endif
</body>
</html>