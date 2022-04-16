<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/common/images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="/assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/assets/plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/assets/plugins/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/assets/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/assets/plugins/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/assets/common/css/custom.min.css" rel="stylesheet">
    <link href="/assets/common/css/base.css?{{ now()->format('YmdHis') }}" rel="stylesheet">
    @stack('links')
</head>

<body class="@yield('body_class')">

    @yield('inner_body')

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/assets/plugins/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/assets/plugins/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/assets/plugins/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/assets/plugins/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/assets/plugins/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/assets/plugins/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/assets/plugins/Flot/jquery.flot.js"></script>
    <script src="/assets/plugins/Flot/jquery.flot.pie.js"></script>
    <script src="/assets/plugins/Flot/jquery.flot.time.js"></script>
    <script src="/assets/plugins/Flot/jquery.flot.stack.js"></script>
    <script src="/assets/plugins/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/assets/plugins/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/assets/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/assets/plugins/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/assets/plugins/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/assets/plugins/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/assets/plugins/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/assets/plugins/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/assets/plugins/moment/min/moment.min.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/assets/common/js/custom.min.js"></script>
    @stack('scripts')

</body>
</html>
