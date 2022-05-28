@extends('admin.layouts.app')

@inject('type', 'App\ModelItems\Event\Type')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/table.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>大会一覧</h2>
                <div class="d-block d-lg-none">
                    <a href="{{ route('admin.tournament.add') }}" class="btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.tournament.list') }}" method="post">
                @csrf
                <input type="hidden" name="type_id" value="{{ $searchParams['type_id'] ?? null }}">
                <div id="types" class="d-flex align-items-center text-nowrap overflow-x-scroll">
                    <span class="mr-2 font-weight-bold">種目種別：</span>
                    <button type="button" class="btn btn-sm rounded-pill @if(isset($searchParams['type_id']) === false) btn-dark @else btn-light hover-dark @endif" data-type-id="">すべて</button>
                    @foreach($type::$items as $typeId => $typeName)
                    <button type="button" class="btn btn-sm rounded-pill @if(isset($searchParams['type_id']) && $searchParams['type_id'] === (string)$typeId) btn-{{ $type::colorClass($typeId) }} @else btn-light hover-{{ $type::colorClass($typeId) }} @endif" data-type-id="{{ $typeId }}">{{ $typeName }}</button>
                    @endforeach
                </div>
                <div class="row align-items-center mx-0">
                    <div class="col-sm-2 px-0">
                        <div class="form-group">
                            <label class="col-form-label">開催日</label>
                            @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => $searchParams['date'] ?? ''])
                        </div>
                    </div>
                    <div class="col-sm-4 pl-sm-2 px-0">
                        <div class="form-group">
                            <label class="col-form-label d-">フリーワード検索</label>
                            @include('admin.commons.components.html.text', ['fieldName' => 'keyword', 'default' => $searchParams['keyword'] ?? '', 'placeholder' => '種目名、場所'])
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
                    {{ $tournaments->links('admin.commons.components.html.pagination') }}
                </div>
                <div class="d-none d-lg-block">
                    <a href="{{ route('admin.tournament.add') }}" class="btn btn-sm btn-dark mx-0"><i class="fas fa-plus-circle mr-1"></i>新規登録</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-striped jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="w-50-px"></th>
                            <th class="w-100-px">
                                種目種別
                            </th>
                            <th class="w-200-px">
                                種目名
                            </th>
                            <th class="w-150-px">
                                場所
                            </th>
                            <th class="w-150-px">
                                開催日時
                            </th>
                            <th class="w-100-px">
                                募集数
                            </th>
                            <th class="w-100-px">
                                参加費
                            </th>
                            <th class="w-50-px">
                                状態
                            </th>
                            <th class="w-150-px">
                                操作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tournaments as $tournament)
                        <tr>
                            <td>
                                @include('admin.commons.components.html.checkbox', ['fieldName' => '', 'class' => 'icheck-blue'])
                            </td>
                            <td>
                                <span class="badge badge-{{ optional($tournament->event)->typeColorClass() }}">{{ optional($tournament->event)->typeName() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.tournament.detail', $tournament->id)}}">{{ optional($tournament->event)->name }}</a>
                            </td>
                            <td>
                                {{ optional($tournament->place)->name }}
                            </td>
                            <td>
                                {{ $tournament->formatDate() }} {{ $tournament->start_time }}
                            </td>
                            <td>
                                {{ $tournament->formatApplicants() }}
                            </td>
                            <td>
                                {{ $tournament->formatEntryFee() }}
                            </td>
                            <td>
                                {{-- 大会が公開中の場合 --}}
                                @if($tournament->isOpen())
                                    <i class="fas fa-eye fa-lg" data-toggle="tooltip" data-placement="top" title="公開中"></i>
                                @else
                                    <i class="fas fa-eye-slash fa-lg" data-toggle="tooltip" data-placement="top" title="非公開"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tournament.detail', $tournament->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="詳細"><i class="fas fa-file-alt"></i></a>
                                <a href="{{ route('admin.tournament.edit', $tournament->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="編集"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="削除"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{-- ページネーション --}}
                {{ $tournaments->links('admin.commons.components.html.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- tooltip初期化 --}}
@include('admin.commons.components.js.tooltip')

{{-- icheckの初期化 --}}
@include('admin.commons.components.js.icheck_blue')

{{-- 検索条件リセット --}}
@include('admin.commons.components.js.search_reset')

@push('scripts')
<script type="text/javascript">
$(function(){
    $('#types button').click(function() {
        var typeId = $(this).attr('data-type-id');
        $('input[name="type_id"]').val(typeId);
        $(this).closest('form').submit();
    })
});
</script>
@endpush
