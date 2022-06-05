@extends('admin.layouts.app')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/admin/css/detail.css?{{ now()->format('YmdHis') }}">
@endpush

@section('content')
<div class="col-sm-12 px-0">
    {{-- 要素を左右中央揃え --}}
    <div class="d-flex justify-content-center">
        <div class="x_panel px-1 px-sm-3 col-sm-6">
            <div class="x_title">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>大会詳細</h2>
                    <div class="d-block d-lg-none">
                        <a href="{{ route('admin.tournament.edit', $tournament->id)}}" class="btn btn-dark mx-0"><i class="fas fa-edit mr-1"></i>編集</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div></div>
                    <div class="d-none d-lg-block">
                        <a href="{{ route('admin.tournament.edit', $tournament->id)}}" class="btn btn-dark mx-0"><i class="fas fa-edit mr-1"></i>編集</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">基本情報</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="panel-list">
                                    <li class="clearfix">
                                        <div class="panel-label">種目種別</div>
                                        <div class="panel-value"><span class="badge badge-{{ optional($tournament->event)->typeColorClass() }}">{{ optional($tournament->event)->typeName() }}</span></div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">種目名</div>
                                        <div class="panel-value">{{ optional($tournament->event)->name }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">場所</div>
                                        <div class="panel-value">
                                            {{-- 公式サイトのURLが登録されている場合 --}}
                                            @if(optional($tournament->place)->official_site_url)
                                                <a target="_blank" href="{{ optional($tournament->place)->official_site_url }}" data-toggle="tooltip" data-placement="top" title="クリックして公式サイトに移動">{{ optional($tournament->place)->name }}</a>
                                            @else
                                                {{ optional($tournament->place)->name }}
                                            @endif
                                            {{-- GoogleマップのURLが登録されている場合 --}}
                                            @if(optional($tournament->place)->google_map_url)
                                                <a target="_blank" class="ml-1" href="{{ optional($tournament->place)->google_map_url }}" data-toggle="tooltip" data-placement="top" title="クリックしてGoogleマップに移動"><i class="fas fa-map-marker-alt fa-lg"></i></a>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">開催日時</div>
                                        <div class="panel-value">{{ optional($tournament->date)->isoFormat('YYYY年M月D日(ddd)') }} {{ $tournament->start_time }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">募集数</div>
                                        <div class="panel-value">{{ $tournament->formatApplicants() }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">参加費</div>
                                        <div class="panel-value">{{ $tournament->formatEntryFee() }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">状態</div>
                                        <div class="panel-value">{{ $tournament->statusName() }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 mb-sm-4">
                    <div class="text-center mt-4 mt-sm-0 text-nowrap overflow-x-scroll">
                        <a href="{{ route('admin.tournament.list') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-list mr-1"></i>一覧へ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- tooltip初期化 --}}
@include('admin.commons.components.js.tooltip')
