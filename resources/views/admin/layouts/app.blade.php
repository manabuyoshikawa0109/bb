@extends('admin.layouts.base')

@section('body_class', $agent->isMobile() ? 'nav-sm' : 'nav-md')

@section('inner_body')
<div class="container body">
    <div class="main_container">
        @include('admin.commons.sidebar')
        <!-- top navigation -->
        @include('admin.commons.nav')
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->
        <!-- footer content -->
        @include('admin.commons.footer')
        <!-- /footer content -->
    </div>
</div>
@endsection

{{-- アラート表示 --}}
@include('admin.commons.components.js.success_alert')
