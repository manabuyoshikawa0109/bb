@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/table.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>場所マスタ</h2>
                <div class="d-block d-lg-none">
                    <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.place.register') }}" method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div></div>
                    <div class="d-none d-lg-block">
                        <button type="button" class="add-row-btn btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>行を追加</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings @if($places->isEmpty()) d-none @endif">
                                <th class="w-200-px">場所名@required()</th>
                                <th class="w-350-px">公式サイトURL</th>
                                <th class="w-350-px">GoogleマップのURL
                                    <i class="ml-1 fas fa-question-circle"
                                       data-toggle="popover"
                                       data-html="true"
                                       title="GoogleマップのURL"
                                       data-content="GoogleマップのURLは下記より取得できます。<br><br>Googleマップで場所検索 > 「共有」 > 「リンクを送信する」 > 「共有リンク」をコピー<br><br><a target='_blank' href='{{ config('admin.setting.google_map.top_page_url') }}'>Googleマップへ移動</a>">
                                    </i>
                                </th>
                                <th class="w-100-px">削除</th>
                            </tr>
                        </thead>

                        <tbody id="items">
                            @foreach ($places as $place)
                                @include('admin.pages.place.row', ['place' => $place ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="form-submit-button-area" class="col-12 text-center @if($places->isEmpty()) d-none @endif">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@php
$row = view('admin.pages.place.row', ['place' => $placeInstance ])->render();
// 改行を全て取り除く
$row = str_replace(array("\r\n", "\r", "\n"), '', $row);
@endphp

{{-- テーブル初期設定JS --}}
@include('admin.commons.components.js.table', ['newId' => $newId, 'row' => $row ])
