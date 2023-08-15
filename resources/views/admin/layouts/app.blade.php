@extends('admin.layouts.base')

@section('html-class', 'semi-dark color-header headercolor2')

@section('inner-body')
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('admin.commons.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('admin.commons.header')
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            @yield('content')
        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('admin.commons.footer')
</div>
<!--end wrapper-->
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {

});
</script>
@endpush
