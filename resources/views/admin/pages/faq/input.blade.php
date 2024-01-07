@extends('admin.layouts.app')

@php
$url = route('admin.faq.create');
$pageTitle = 'FAQ新規登録';
$buttonText = '新規登録する';
if ($faq->exists) {
    $url = route('admin.faq.update', $faq->id);
    $pageTitle = 'FAQ編集';
    $buttonText = '更新する';
}
@endphp

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
                                        <label for="question" class="form-label">質問@required()</label>
                                        @include('admin.commons.components.html.text', [
                                            'id' => 'question',
                                            'fieldName' => 'question',
                                            'default' => $faq->question,
                                            'maxLength' => 100,
                                            'placeholder' => '例】キャンセル代はいつ頃からかかりますか？',
                                        ])
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer" class="form-label">回答@required()</label>
                                        @include('admin.commons.components.html.textarea', [
                                            'id' => 'answer',
                                            'fieldName' => 'answer',
                                            'default' => $faq->answer,
                                            'maxLength' => 500,
                                            'placeholder' => "例】キャンセル代は試合当日3日前から発生します。
前日まではダブルス3,300円・シングルス3,000円、当日キャンセルはダブルス5,000円・シングルス4,400円です。",
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