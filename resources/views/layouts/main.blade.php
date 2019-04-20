<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('pageTitle')</title>

        <link href="/lumino/css/bootstrap.min.css" rel="stylesheet">
        <link href="/lumino/css/styles.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        html {
          background-image: url('/music_waves.jpg');
          background-size: cover;
          opacity: .9
        }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            body{
              padding-top: 0px;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('marketplace') }}">MarketPlace</a>
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <a href="{{ route('logout') }}">Logout</a>
                    @else
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ url('/marketplace') }}">MarketPlace</a>
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="container">
              @yield("app-content")
            </div>
        </div>

        <script type="text/javascript">
            var _token = '{!! Session::token() !!}';
            var _url = '{!! url("/") !!}';

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        @yield("pre-javascript")
        <script src="/lumino/js/jquery-1.11.1.min.js"></script>
        <!--script src="https://code.jquery.com/jquery-3.3.1.min.js"></script-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
        <script src="js/app.js"></script>
        <script src="/lumino/js/bootstrap-datepicker.js"></script>
        <script src="/lumino/js/custom.js"></script>
        @yield("javascript")
    </body>
</html>
