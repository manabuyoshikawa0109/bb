<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Solartec - Renewable Energy Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="/assets/user/images/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="/assets/common/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="/assets/user/plugins/animate/animate.css" rel="stylesheet">
    <link href="/assets/user/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets/user/plugins/lightbox/css/lightbox.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets/user/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="/assets/user/css/style.css" rel="stylesheet">
    <link href="{{ disableCacheWhenModified('/assets/user/css/base.css') }}" rel="stylesheet">
    @stack('links')
</head>

<body>
    @yield('inner_body')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/user/plugins/wow/wow.min.js"></script>
    <script src="/assets/user/plugins/easing/easing.min.js"></script>
    <script src="/assets/user/plugins/waypoints/waypoints.min.js"></script>
    <script src="/assets/user/plugins/counterup/counterup.min.js"></script>
    <script src="/assets/user/plugins/owlcarousel/owl.carousel.min.js"></script>
    <script src="/assets/user/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="/assets/user/plugins/lightbox/js/lightbox.min.js"></script>
    <!-- Template Javascript -->
    <script src="/assets/user/js/main.js"></script>
    <script src="{{ disableCacheWhenModified('/assets/common/js/base.js') }}"></script>
    @stack('scripts')
</body>
</html>
