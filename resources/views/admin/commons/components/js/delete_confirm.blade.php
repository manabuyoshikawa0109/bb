{{--
    削除時の確認ダイアログ表示コンポーネント
    $message : 確認ダイアログに表示するメッセージ
--}}

@push('scripts')
<script type="text/javascript">
$(function(){
    $('.btn-delete').click(function() {
        if (!confirm('{{ $message }}')) {
            return false;
        }
    });
});
</script>
@endpush
