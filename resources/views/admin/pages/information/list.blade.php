@extends('admin.layouts.app')

@inject('status', 'App\ModelItems\Information\Status')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/table.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>お知らせ一覧</h2>
                <div class="d-block d-lg-none">
                    <a href="{{ route('admin.information.add') }}" class="btn btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.information.list') }}" method="post">
                @csrf
                <input type="hidden" name="status_scope" value="{{ $searchParams['status_scope'] ?? null }}">
                <div class="d-flex align-items-center text-nowrap overflow-x-scroll btn-search">
                    <span class="mr-2 font-weight-bold">ステータス：</span>
                    <button type="button" class="btn btn-sm rounded-pill @if(empty($searchParams['status_scope'])) btn-dark @else btn-light hover-dark @endif" data-statu-scope="">すべて</button>
                    @foreach($status::$scopes as $statusName => $statusScope)
                    <button type="button" class="btn btn-sm rounded-pill @if(isset($searchParams['status_scope']) && $searchParams['status_scope'] === (string)$statusScope) btn-{{ $status::colorClass($statusName) }} @else btn-light hover-{{ $status::colorClass($statusName) }} @endif" data-status-scope="{{ $statusScope }}">{{ $statusName }}</button>
                    @endforeach
                </div>

                <div class="row align-items-center mx-0">
                    <div class="col-sm-2 px-0">
                        <div class="form-group">
                            <label class="col-form-label">日付</label>
                            @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => $searchParams['date'] ?? ''])
                        </div>
                    </div>
                    <div class="col-sm-4 pl-sm-2 px-0">
                        <div class="form-group">
                            <label class="col-form-label">フリーワード検索</label>
                            @include('admin.commons.components.html.text', ['fieldName' => 'keyword', 'default' => $searchParams['keyword'] ?? '', 'placeholder' => '件名、本文'])
                        </div>
                    </div>
                    <div class="col-sm-3 pl-sm-2 px-0">
                        <div class="form-group">
                            <label class="col-form-label d-none d-sm-inline-block">&nbsp;</label>
                            <div class="d-flex align-items-center mt-3 mt-sm-0">
                                <button type="submit" class="btn btn-sm btn-dark mb-0"><i class="fas fa-search mr-1"></i>検索</button>
                                <button id="search-reset-button" type="button" class="btn btn-sm btn-light border m-0"><i class="fas fa-undo mr-1"></i>検索条件をリセット</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-between align-items-center mt-3 mb-1">
                <div>
                    {{-- ページネーション --}}
                    {{ $informations->links('admin.commons.components.html.pagination') }}
                </div>
                <div class="d-none d-lg-block">
                    <a href="{{ route('admin.information.add') }}" class="btn btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-striped jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="w-100-px">
                                ステータス
                            </th>
                            <th class="w-200-px">
                                公開期間
                            </th>
                            <th class="w-150-px">
                                日付
                            </th>
                            <th class="w-150-px">
                                件名
                            </th>
                            <th class="w-150-px">
                                操作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informations as $information)
                        <tr>
                            <td>
                                <span class="badge badge-{{ $information->statusColorClass() }}">{{ $information->statusName() }}</span>
                            </td>
                            <td>
                                {{ optional($information->release_start_date)->format('Y年n月j日') }} 〜 {{ optional($information->release_end_date)->format('Y年n月j日') }}
                            </td>
                            <td>
                                {{ optional($information->date)->format('Y年n月j日') }}
                            </td>
                            <td class="ellipsis">
                                <a href="{{ route('admin.information.detail', $information->id) }}">{{ $information->subject }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.information.detail', $information->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="詳細"><i class="fas fa-file-alt"></i></a>
                                <a href="{{ route('admin.information.edit', $information->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="編集"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.information.delete', $information->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="削除" onclick="return confirm('お知らせを削除しますか？')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{-- ページネーション --}}
                {{ $informations->links('admin.commons.components.html.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- tooltip初期化 --}}
@include('admin.commons.components.js.tooltip')

{{-- 検索条件リセット --}}
@include('admin.commons.components.js.search_reset')

@push('scripts')
<script type="text/javascript">
$(function(){
    $('.btn-search button').click(function() {
        var statusScope = $(this).attr('data-status-scope');
        $('input[name="status_scope"]').val(statusScope);
        $(this).closest('form').submit();
    });
});
</script>
@endpush
