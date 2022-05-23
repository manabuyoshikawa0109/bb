{{-- tooltipの初期化 --}}
@push('scripts')
<script type="text/javascript">
$(function(){
    // 参考：https://getbootstrap.jp/docs/4.2/components/tooltips/
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
