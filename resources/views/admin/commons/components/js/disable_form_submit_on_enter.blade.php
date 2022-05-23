{{-- フォームでEnterキーによるsubmitを無効化する --}}
@push('scripts')
<script type="text/javascript">
$(function(){
    $('input').on('keydown', function(e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            return false;
        }
        return true;
    });
});
</script>
@endpush
