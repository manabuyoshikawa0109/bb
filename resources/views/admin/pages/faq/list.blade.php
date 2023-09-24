@extends('admin.layouts.app')

@php
// 通常時、順番は1番から取得
$orders = $faqs->pluck('order')->toArray();
if ($errors->any()) {
    // バリデーションエラー時、順番は0番から取得
    $orders = array_keys(old('ids', []));
}
@endphp

@push('links')
<style>
/* アコーディオンヘッダー内の疑似要素(矢印アイコン)を表示させない */
.accordion-button::after {
    content: none !important;
}
</style>
@endpush

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">FAQ管理</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.home.index') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">FAQ管理</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-12 col-lg-9 mx-auto">
        <div class="text-center">
            <h5 class="mb-0 text-uppercase d-flex justify-content-center align-items-center">
                よくある質問 (FAQ)
                <i class="lni lni-question-circle ms-1" role="button" data-bs-toggle="popover" title="FAQの順番を変更" data-bs-content="FAQをドラッグ&ドロップして順番を変更できます。"></i>
            </h5>
            <hr/>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.faq.save') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-end pb-2 px-3">
                        <button id="btn-add-faq" type="button" class="btn btn-dark radius-30"><i class="bx bx-plus-circle"></i>FAQを追加</button>
                    </div>
                    <div class="accordion accordion-flush" id="faq-accordions">
                        @foreach ($orders as $order)
                            @php
                            $faq = $faqs->where('order', $order)->first();
                            @endphp
                            @include('admin.pages.faq.row')
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center p-3">
                        <button type="submit" class="btn btn-dark"><i class="bx bx-save"></i>保存する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end row-->
@endsection

@include('admin.commons.components.js.popover')
@push('scripts')
{{-- FAQ行の並び替え用にjQuery UIを読み込み --}}
<script src="/assets/admin/js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
    // FAQ行の並び替え初期設定
    $('#faq-accordions').sortable({
        handle: '.accordion-header',
        // jquery-uiではデフォルトでbuttonタグ要素をドラッグ&ドロップして並び替えできないようになっている
        // その為cancelオプションでbuttonタグの指定を外す
        // 参考：https://kamegu.hateblo.jp/entry/jquery-ui/sortable-handle
        cancel: "input, textarea, select, option",
    });

    // FAQ行を文字列に変更、改行を除外(htmlタグをエスケープしない)
    var row = '{!! str_replace(array("\r\n", "\r", "\n"), '', view('admin.pages.faq.row')->render()) !!}';
    // FAQ追加
    $('#btn-add-faq').click(function() {
        $('#faq-accordions').append(row);
    });

    // FAQ削除
    $('#faq-accordions').on('click', '.accordion-button .lni-close', function() {
        $(this).closest('.accordion-item').remove();
        // フェードアウトしてからFAQを削除
        // $(this).closest('.accordion-item').fadeOut(500).queue(function() {
        //     $(this).remove();
        // });
    });

    // アコーディオンヘッダー内のテキストボックスクリック時、アコーディオンを開閉しない
    // アコーディオンヘッダーのクリックイベントよりテキストボックスのfocus、blurイベントの方が呼ばれるのが早い
    // 参考：https://stackoverflow.com/questions/74099301/stop-opening-of-bootstrap-accordion-when-textbox-is-clicked-using-a-listener-fun
    $('#faq-accordions').on('focus', '.accordion-button input', function() {
        $(this).closest('.accordion-button').attr('data-bs-toggle', 'disabled');
    }).on('blur', '.accordion-button input', function() {
        $(this).closest('.accordion-button').attr('data-bs-toggle', 'collapse');
    });
});
</script>
@endpush
