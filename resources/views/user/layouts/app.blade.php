@extends('user.layouts.base')

@section('body_class', 'nav-md')

@section('inner_body')
<div class="container body">
    <div class="main_container">
        @include('user.commons.sidebar')
        <!-- top navigation -->
        @include('user.commons.nav')
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->
        <!-- footer content -->
        @include('user.commons.footer')
        <!-- /footer content -->
    </div>
</div>
@endsection
