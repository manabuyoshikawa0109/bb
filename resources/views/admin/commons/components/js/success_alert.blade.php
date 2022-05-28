{{--
    アラート表示用コンポーネント
    セッション（フラッシュ）にmessageが設定されていれば表示
--}}

@if(session('message'))
@push('links')
<link href="/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
@endpush

@push('scripts')
{{-- フラッシュメッセージ表示--}}
<script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$(function(){
    Swal.fire({
        icon: 'success',
        title: '{{ session('message') }}',
        showConfirmButton: false,
        timer: 1500
    })
});
</script>
@endpush
@endif
