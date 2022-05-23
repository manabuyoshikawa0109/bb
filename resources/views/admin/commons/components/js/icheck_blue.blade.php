{{-- icheck(青色)の初期化 --}}
@push('scripts')
<script type="text/javascript">
function initIcheckBlue(){
    $('.icheck-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
}
$(function(){
    initIcheckBlue();
});
</script>
@endpush
