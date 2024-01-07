@extends('admin.layouts.app')

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
                <li class="breadcrumb-item active" aria-current="page">FAQ一覧</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.faq.list') }}" method="post">
            @csrf
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    @include('admin.commons.components.html.text', [
                        'fieldName' => 'keyword',
                        'class' => 'ps-5 radius-30',
                        'default' => $searchParam->keyword,
                        'placeholder' => 'フリーワード検索',
                    ])
                    <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                </div>
                <div class="ms-auto">
                    <button id="fix-faq-order-btn" type="button" class="btn btn-dark radius-30 mt-2 mt-lg-0" @if($faqs->isEmpty()) disabled @endif><i class="fa-solid fa-arrows-up-down"></i>並び順確定</button>
                    <a href="{{ route('admin.faq.add') }}" class="btn btn-dark radius-30 mt-2 mt-lg-0"><i class="bx bx-plus-circle"></i>新規登録</a>
                </div>
            </div>
            @include('admin.commons.components.html.errors', ['fieldName' => 'ids'])
        </form>
        <form id="sort-form" action="{{ route('admin.faq.sort') }}" method="post">
            @csrf
            <div class="table-responsive js-scrollable">
                <table class="table table-layout-fixed mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 900px;">質問</th>
                            <th style="width: 100px;">並び替え<i class="lni lni-question-circle ms-1 align-middle" role="button" data-bs-toggle="popover" title="FAQの並び順を変更" data-bs-content="ドラッグ&ドロップして並び順を変更できます"></i></th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody class="faqs">
                        @foreach ($faqs as $faq)
                        <tr>
                            <input type="hidden" name="ids[]" value="{{ $faq->id }}">
                            <td class="text-truncate">{{ $faq->question }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" class="arrows-up-down-btn"><i class="fa-solid fa-arrows-up-down"></i></a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('admin.faq.edit', $faq->id) }}"><i class="bx bxs-edit"></i></a>
                                    <a href="{{ route('admin.faq.delete', $faq->id) }}" class="ms-3" onclick="return confirm('FAQを削除しますか？')"><i class="bx bxs-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection

@include('admin.commons.components.js.popover')
@push('scripts')
{{-- FAQ行の並び替え用にjQuery UIを読み込み --}}
<script src="/assets/admin/js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
    // FAQ行の並び替え初期設定
    $('.faqs').sortable({
        handle: '.arrows-up-down-btn',
    });

    // フリーワード入力時即時検索実行
    $('input[name="keyword"]').keyup(function (e) {
        $(this).closest('form').submit();
    });

    //「並び順確定」ボタンクリック時、並び替えのフォーム送信
    $('#fix-faq-order-btn').click(function () {
        $('#sort-form').submit();
    });
});
</script>
@endpush
