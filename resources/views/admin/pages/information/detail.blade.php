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
                    <h2>お知らせ詳細</h2>
                    <div class="d-block d-lg-none">
                        <a href="{{ route('admin.information.edit', $information->id) }}" class="btn btn-dark mx-0"><i class="fas fa-edit mr-1"></i>編集</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div></div>
                    <div class="d-none d-lg-block">
                        <a href="{{ route('admin.information.edit', $information->id)}}" class="btn btn-dark mx-0"><i class="fas fa-edit mr-1"></i>編集</a>
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
                                        <div class="panel-label">ステータス</div>
                                        <div class="panel-value"><span class="badge badge-{{ $information->statusColorClass() }}">{{ $information->statusName() }}</span></div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">公開期間</div>
                                        <div class="panel-value">{{ optional($information->release_start_date)->format('Y年n月j日') }} 〜 {{ optional($information->release_end_date)->format('Y年n月j日') }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">日付</div>
                                        <div class="panel-value">{{ optional($information->date)->format('Y年n月j日') }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">件名</div>
                                        <div class="panel-value">{{ $information->subject }}</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="panel-label">本文</div>
                                        <div class="panel-value">{!! nl2br($information->body) !!}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 mb-sm-4">
                    <div class="text-center mt-4 mt-sm-0 text-nowrap overflow-x-scroll">
                        <a href="{{ route('admin.information.list') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-list mr-1"></i>一覧へ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
