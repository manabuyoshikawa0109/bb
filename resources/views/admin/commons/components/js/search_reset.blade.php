{{--
    検索条件リセットコンポーネント
--}}
@push('scripts')
<script type="text/javascript">
$(function(){
    $('#search-reset-button').click(function() {
        $(this).closest('form').append('<input type="hidden" name="reset" value="1">').submit();
    })
});
</script>
@endpush
