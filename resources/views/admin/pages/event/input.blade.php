@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/event.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <h2>種目マスタ</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <p>募集数・参加費・開始時間は<code>「大会管理 > 新規登録」</code>で種目選択時にデフォルトで反映されます。</p>
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="w-250-px">種目名<span class="badge badge-danger ml-1">必須</span></th>
                            <th class="w-100-px">募集数</th>
                            <th class="w-150-px">参加費</th>
                            <th class="w-150-px">開始時間</th>
                            <th class="w-100-px">ダブルス</th>
                            <th class="w-100-px">ミックス</th>
                            <th class="w-100-px">削除</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for ($i = 0; $i < 7; $i++)
                            @include('admin.pages.event.row', ['event' => auth('admin')->user() ])
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
