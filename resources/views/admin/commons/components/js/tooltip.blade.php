{{--
    ツールチップの初期化コンポーネント
--}}
@push('scripts')
<script type="text/javascript">
$(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endpush
