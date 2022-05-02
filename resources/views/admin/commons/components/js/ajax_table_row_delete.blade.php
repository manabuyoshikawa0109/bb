{{--
    テーブルの行＆データの非同期削除コンポーネント
    参考：https://qiita.com/u-dai/items/d43e932cd6d96c09b69a
--}}

@push('scripts')
<script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$(function(){
    $('.ajax-delete').click(function() {
        Swal.fire({
            title: '削除しますか？',
            text: "保存されている種目情報を削除します。",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '削除する',
            cancelButtonText: 'キャンセル',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'POST',
                    url  : '{{ route('admin.api.event.delete') }}',
                    // attrでhtmlのカスタムデータ属性から直接取得(jsのキャッシュから取得しない)
                    // 参考：https://qiita.com/Kta-M/items/2eda39750abd10df9801
                    data : {
                        'id' : $(this).attr('data-id'),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // csrfトークンの追加
                    }
                })
                .done(function () {
                    // 成功した場合の処理
                    $(this).closest('tr').remove();
                    hideTableHeader();
                    Swal.fire({
                        icon: 'success',
                        title: '種目情報を削除しました。',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                })
                .fail(function () {
                    // エラーの場合の処理
                    Swal.fire({
                        icon: 'error',
                        title: 'エラーが発生しました。',
                        text: 'しばらく経ってから再度お試しください。',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                })
            }
        })
    });
});
</script>
@endpush
