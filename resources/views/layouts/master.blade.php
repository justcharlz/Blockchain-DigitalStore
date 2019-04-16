<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Decent Beats</title>
	<link href="/lumino/css/bootstrap.min.css" rel="stylesheet">
	<link href="/lumino/css/datepicker3.css" rel="stylesheet">
	<link href="/lumino/css/styles.css" rel="stylesheet">

  <!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        @yield('stylesheets')
    </head>
    <body>
        @include("layouts.navigation")
        @if(auth::user())
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        @include('partials.errors')
        @include('partials.status')
        @include('partials.message')
        </div>
        @else
        @include('partials.errors')
        @include('partials.status')
        @include('partials.message')
        @endif
        <div class="container-fluid">
            <div class="row-fluid">
                @yield("app-content")
            </div>
        </div>

        <!--footer class="footer bg-dark">
            <div class="container-fluid">
                <span class="text-muted">&copy; {!! date('Y'); !!} <a href="">You</a>
                    @if (Session::get('original_user'))
                        <a class="btn btn-link btn-sm" href="/users/switch-back">Return to your Login</a>
                    @endif
                </span>
            </div>
        </footer-->

        <script type="text/javascript">
            var _token = '{!! Session::token() !!}';
            var _url = '{!! url("/") !!}';
        </script>
        @yield("pre-javascript")
        <script src="/lumino/js/jquery-1.11.1.min.js"></script>
        <!--script src="https://code.jquery.com/jquery-3.3.1.min.js"></script-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
        <script src="js/app.js"></script>
        <!--script src="/lumino/js/bootstrap.min.js"></script-->
        <script src="/lumino/js/chart.min.js"></script>
        <script src="/lumino/js/chart-data.js"></script>
        <script src="/lumino/js/easypiechart.js"></script>
        <script src="/lumino/js/easypiechart-data.js"></script>
        <script src="/lumino/js/bootstrap-datepicker.js"></script>
        <script src="/lumino/js/custom.js"></script>
        <script>
          window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
        });
        };
        </script>
        @yield("javascript")
    </body>
</html>
