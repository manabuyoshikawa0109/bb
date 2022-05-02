@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/table.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>種目マスタ</h2>
                <div class="d-block d-lg-none">
                    <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.event.register') }}" method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div>種目名・削除以外の項目は<code>「大会管理 > 新規登録」</code>で種目選択時にデフォルトで反映される設定値です。</div>
                    <div class="d-none d-lg-block">
                        <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings @if($events->isEmpty()) d-none @endif">
                                <th class="w-250-px">種目名@required()</th>
                                <th class="w-100-px">募集数</th>
                                <th class="w-150-px">参加費</th>
                                <th class="w-150-px">開始時間</th>
                                <th class="w-100-px">ダブルス</th>
                                <th class="w-100-px">ミックス</th>
                                <th class="w-100-px">削除</th>
                            </tr>
                        </thead>

                        <tbody id="items">
                            @foreach ($events as $event)
                                @include('admin.pages.event.row', ['event' => $event ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="form-submit-button-area" class="col-12 text-center @if($events->isEmpty()) d-none @endif">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@php
$row = view('admin.pages.event.row', ['event' => $eventInstance ])->render();
// 改行を全て取り除く
$row = str_replace(array("\r\n", "\r", "\n"), '', $row);
@endphp

{{-- テーブル初期設定JS --}}
@include('admin.commons.components.js.table', ['newId' => $newId, 'row' => $row ])
