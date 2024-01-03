@extends('admin.layouts.app')

@php
$url = route('admin.information.create');
$pageTitle = 'お知らせ新規登録';
$buttonText = '新規登録する';
if ($information->exists) {
    $url = route('admin.information.update', $information->id);
    $pageTitle = 'お知らせ編集';
    $buttonText = '更新する';
}
@endphp

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">お知らせ管理</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.home.index') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body py-4 px-2 p-sm-4">
        <h5 class="card-title">{{ $pageTitle }}</h5>
        <hr />
        <div class="form-body mt-4">
            <form action="{{ $url }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="border border-3 p-3 p-sm-4 rounded">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="release-period" class="form-label">公開期間</label>
                                        <div class="d-block d-sm-flex align-items-start">
                                            {{-- display:flexによりエラーメッセージが横並びになってしまう為divタグで囲んでおく --}}
                                            <div class="w-100 mb-2 mb-sm-0">
                                                @include('admin.commons.components.html.date', [
                                                    'id' => 'release-start-date',
                                                    'fieldName' => 'release_start_date',
                                                    'default' => $information->release_start_date?->format('Y-m-d'),
                                                ])
                                            </div>
                                            <div class="d-none d-sm-block p-2">〜</div>
                                            <div class="w-100">
                                                @include('admin.commons.components.html.date', [
                                                    'id' => 'release-end-date',
                                                    'fieldName' => 'release_end_date',
                                                    'default' => $information->release_end_date?->format('Y-m-d'),
                                                ])
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mt-1">※公開開始日を入力しない場合、お知らせはすぐに公開されます</small>
                                        <small class="text-muted d-block">※公開終了日を入力しない場合、お知らせはずっと公開されます</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">件名@required()</label>
                                        @include('admin.commons.components.html.text', [
                                            'id' => 'subject',
                                            'fieldName' => 'subject',
                                            'default' => $information->subject,
                                            'maxLength' => 100,
                                            'placeholder' => '例】夏季休業のお知らせ',
                                        ])
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">本文</label>
                                        @include('admin.commons.components.html.textarea', [
                                            'id' => 'body',
                                            'fieldName' => 'body',
                                            'default' => $information->body,
                                            'maxLength' => 1000,
                                            'placeholder' => "例】平素は格別のお引き立てをいただき厚くお礼申し上げます。
弊社では、誠に勝手ながら下記日程を夏季休業とさせていただきます。

■夏季休業期間
0000年00月00日(〇)　～　00月00日(〇)

休業期間中にいただいたお問合せについては、営業開始日以降に順次回答させていただきます。
皆様には大変ご不便をおかけいたしますが、何卒ご理解の程お願い申し上げます。",
                                            'rows' => 15,
                                        ])
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 offset-sm-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark">{{ $buttonText }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </form>
        </div>
    </div>
</div>
@endsection