{{--
    switcheryの初期化JSコンポーネント
--}}
@push('scripts')
<script type="text/javascript">
$(function(){
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            color : '#26B99A',
        });
    });
});
</script>
@endpush
