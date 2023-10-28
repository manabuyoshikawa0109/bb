{{--
    dropifyの初期化コンポーネント
    $defaultMessage : デフォルトで表示するメッセージ
    $deleteButtonText : 削除ボタンの文字
    $errorMessage : エラー発生時のメッセージ
    $fileSizeErrorMessage : ファイルサイズのエラーメッセージ
    $fileExtensionErrorMessage : ファイル拡張子のエラーメッセージ
--}}
@push('links')
<link href="/assets/common/plugins/dropify/css/dropify.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="/assets/common/plugins/dropify/js/dropify.js"></script>
<script type="text/javascript">
$(function() {
    $('.dropify').dropify({
        // メッセージ内にHTMLを使用できるよう、出力時にエスケープしない
        messages: {
            'default': "{!! $defaultMessage ?? 'ファイルをドラッグ&ドロップして<br>アップロード、またはファイルを選択' !!}",
            'replace': "{!! $defaultMessage ?? 'ファイルをドラッグ&ドロップして<br>アップロード、またはファイルを選択' !!}",
            'remove':  "{!! $deleteButtonText ?? '削除' !!}",
            'error':   "{!! $errorMessage ?? 'エラーが発生しました' !!}",
        },
        // javascript変数をPHPの変数として認識されたくないので、Bladeエコーステートメントの前に@マークを追加
        // 参考：https://readouble.com/laravel/9.x/ja/blade.html の@verbatimディレクティブ
        error: {
            'fileSize': "{!! $fileSizeErrorMessage ?? '@{{ value }}B以下のファイルを選択してください。' !!}",
            'fileExtension': "{!! $fileExtensionErrorMessage ?? '指定された拡張子(@{{ value }})のファイルを選択してください。' !!}",
        },
    });
});
</script>
@endpush