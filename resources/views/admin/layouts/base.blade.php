<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
lang="ja"
class="light-style @yield('html-class')"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assets/"
data-template="vertical-menu-template-free"
>
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard - Analytics | BBテニストーナメント</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/assets/admin/images/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="/assets/plugins/boxicons/boxicons.css" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/assets/plugins/font-awesome/css/all.min.css" >

        <!-- Core CSS -->
        <link rel="stylesheet" href="/assets/admin/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="/assets/admin/css/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="/assets/admin/css/demo.css" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="/assets/plugins/perfect-scrollbar/perfect-scrollbar.css" />

        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="/assets/admin/js/helpers.js"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="/assets/admin/js/config.js"></script>
        <link href="/assets/admin/css/base.css?{{ now()->format('YmdHis') }}" rel="stylesheet" >
        @stack('links')
    </head>

    <body>
        @yield('inner_body')

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="/assets/plugins/jquery/jquery.js"></script>
        <script src="/assets/plugins/popper/popper.js"></script>
        <script src="/assets/admin/js/bootstrap.js"></script>
        <script src="/assets/plugins/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="/assets/admin/js/menu.js"></script>

        <!-- Main JS -->
        <script src="/assets/admin/js/main.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        @stack('scripts')
    </body>
</html>
