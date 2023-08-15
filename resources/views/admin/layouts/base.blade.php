<!doctype html>
<html lang="ja" class="@yield('html-class')">

<head>
	<title>Synadmin – Bootstrap5 Admin Template</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="/assets/admin/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="/assets/admin/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets/admin/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/assets/admin/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/admin/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/admin/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="/assets/admin/css/app.css" rel="stylesheet">
	<link href="/assets/admin/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="/assets/admin/css/dark-theme.css" />
	<link rel="stylesheet" href="/assets/admin/css/semi-dark.css" />
	<link rel="stylesheet" href="/assets/admin/css/header-colors.css" />
    @stack('links')
</head>

<body>
    @yield('inner-body')
	<!-- Bootstrap JS -->
	<script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/assets/admin/js/jquery.min.js"></script>
	<script src="/assets/admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets/admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="/assets/admin/js/app.js"></script>
    @stack('scripts')
</body>

</html>