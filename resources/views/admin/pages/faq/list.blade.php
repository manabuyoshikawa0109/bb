@extends('admin.layouts.app')

@php
use App\Models\Faq;
@endphp

@push('links')
<style>
/* アコーディオンヘッダー内の疑似要素を表示させない */
.accordion-button::after {
    content: none !important;
}
/* スマホ時テキストエリアの角を丸くする */
@media (max-width: 575px){
    .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        border-top-left-radius: 0.375rem !important;
        border-bottom-left-radius: 0.375rem !important;
    }
}
</style>
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4 d-flex justify-content-between align-items-center">
    <div><span class="text-muted fw-light">FAQ管理 /</span> 一覧画面</div>
    <button id="btn-add-faq" type="button" class="btn btn-primary"><i class="bx bxs-plus-circle me-1"></i>FAQを追加</a></button>
</h4>

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.faq.save') }}" method="POST">
            @csrf
            <div id="faq-accordions" class="accordion mt-3 accordion-without-arrow">
                @foreach (old('ids', $faqs->pluck('id')->toArray()) as $key => $id)
                @php
                $faq = $faqs->firstWhere('id', $id) ?? new Faq();
                $question = old("questions.{$key}", $faq->question);
                $answer = old("answers.{$key}", $faq->answer);
                @endphp
                @include('admin.pages.faq.row')
                @endforeach
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>保存する</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    var order = {{ count(old('ids', $faqs->pluck('id')->toArray())) + 1 }};
    // FAQ追加
    $('#btn-add-faq').click(function() {
        // FAQ追加行を文字列に変更、改行を除外(htmlタグをエスケープしない)
        var faq = '{!! str_replace(array("\r\n", "\r", "\n"), '', view('admin.pages.faq.row')->render()) !!}';
        faq = faq.replace(/@order@/g, order);
        $('#faq-accordions').append(faq);
        order++;
    });

    // FAQ削除
    $('#faq-accordions').on('click', '.delete-faq', function(){
        // フェードアウトしてからFAQを削除
        $(this).closest('.accordion-item').fadeOut(500).queue(function() {
            $(this).remove();
        });
    });

    // FAQの順番を前にする
    $('#faq-accordions').on('click', '.up-faq', function(){
        var faq = $(this).closest('.accordion-item');
        // 1個前に要素がある場合のみ要素を入れ替え
        if (faq.prev('.accordion-item')) {
            // faqをinsertBeforeで指定した要素の前に移動させる
            // 参考：https://stand-4u.com/web/javascript/jquery-insertbefore.html
            faq.insertBefore(faq.prev('.accordion-item'));
        }
    });

    // FAQの順番を後ろにする
    $('#faq-accordions').on('click', '.down-faq', function(){
        var faq = $(this).closest('.accordion-item');
        // 1個後ろに要素がある場合のみ要素を入れ替え
        if (faq.next('.accordion-item')) {
            // faqをinsertAfterで指定した要素の後に移動させる
            faq.insertAfter(faq.next('.accordion-item'));
        }
    });
});
</script>
@endpush
