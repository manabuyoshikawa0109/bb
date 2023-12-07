@extends('admin.layouts.base')

@php
use App\Enums\Alert;
@endphp

@section('html-class', 'semi-dark color-header headercolor2')

@push('links')
<link rel="stylesheet" href="/assets/admin/plugins/notifications/css/lobibox.min.css" />
@endpush

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
<!-- notification js -->
<script src="/assets/admin/plugins/notifications/js/lobibox.min.js"></script>
<script src="/assets/admin//plugins/notifications/js/notifications.min.js"></script>
<script type="text/javascript">
$(function() {
    {{-- フラッシュメッセージがある時のみ通知メッセージを表示 --}}
    @if(session('message'))
    @php
    // デフォルトの通知メッセージのタイプは「成功」
    $type = Alert::SUCCESS->value;
    $message = session('message');
    $iconClass = Alert::SUCCESS->iconClass();
    // 配列の場合、通知メッセージのタイプが指定されているので判別する
    if (is_array(session('message'))) {
        $type = key(session('message'));
        $message = data_get(session('message'), $type);
        $iconClass = Alert::from($type)->iconClass();
    }
    @endphp
    Lobibox.notify('{{ $type }}', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: '{{ $iconClass }}',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: '{{ $message }}',
	});
    @endif
});
</script>
@endpush
