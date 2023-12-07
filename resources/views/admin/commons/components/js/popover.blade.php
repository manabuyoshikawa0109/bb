{{--
    ポップオーバーの初期化コンポーネント
--}}
@push('scripts')
<script type="text/javascript">
$(function(){
    $('[data-bs-toggle="popover"]').popover();
});
</script>
@endpush
