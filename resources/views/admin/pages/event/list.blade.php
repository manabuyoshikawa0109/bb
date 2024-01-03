@extends('admin.layouts.app')

@php
// エラー発生時はセッションから入力情報を取得
if ($errors->any()) {
    $events = old('events');
}
@endphp

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">種目マスター</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">種目一覧</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.event.save') }}" method="POST">
            @csrf
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="ms-auto">
                    <button type="button" id="btn-add-row" class="btn btn-dark radius-30">
                        <i class="bx bx-plus-circle"></i>種目を追加
                    </button>
                </div>
            </div>
            <div class="table-responsive js-scrollable">
                <table class="table table-layout-fixed mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 250px;">種別@required()</th>
                            <th style="width: 350px;">種目名@required()</th>
                            <th style="width: 150px;">募集数</th>
                            <th style="width: 150px;">参加費</th>
                            <th style="width: 150px;">開催時間</th>
                            <th style="width: 60px;"></th>
                        </tr>
                    </thead>
                    <tbody id="event-rows">
                        @foreach ($events as $key => $event)
                            @include('admin.pages.event.row')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center p-3">
                <button type="submit" class="btn btn-dark"><i class="bx bx-save"></i>保存する</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    // 行を文字列に変更、改行を除外(htmlタグをエスケープしない)
    var row = '{!! str_replace(array("\r\n", "\r", "\n"), '', view('admin.pages.event.row')->render()) !!}';
    // 行追加
    $('#btn-add-row').click(function() {
        $('#event-rows').append(row);
    });

    // 行削除
    $('#event-rows').on('click', '.order-actions a', function() {
        $(this).closest('tr').remove();
    });

    // 種別選択時、種目名が入力されていない場合種別名を入力。募集数に単位を追加
    $('#event-rows').on('change', '.type-select', function() {
        var $nameInput = $(this).closest('tr').find('.name-input');
        var name = $nameInput.val();
        if (!name) {
            var typeName = $(this).find('option:selected').text();
            $nameInput.val(typeName);
        }

        // data属性はjQueryオブジェクトがキャッシュしているデータ属性の値を取得する為、data属性を変更しても変更前の値を取得する
        // attr属性はdata属性の値をそのまま取得する
        var unit = $(this).find('option:selected').attr('data-unit');
        $(this).closest('tr').find("[id^='event-capacity-unit']").text(unit);

    });
});
</script>
@endpush
