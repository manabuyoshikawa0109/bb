{{-- icheck(赤色)の初期化 --}}
@push('scripts')
<script type="text/javascript">
function initIcheckRed(){
    $('.icheck-red').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });
}
$(function(){
    initIcheckRed();
});
</script>
@endpush
