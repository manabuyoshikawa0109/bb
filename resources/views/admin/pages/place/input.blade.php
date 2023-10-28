@extends('admin.layouts.app')

@php
$url = route('admin.place.create');
$pageTitle = '場所新規登録';
$buttonText = '新規登録する';
if ($place->exists) {
    $url = route('admin.place.update', $place->id);
    $pageTitle = '場所編集';
    $buttonText = '更新する';
}
@endphp

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">場所マスター</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
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
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="border border-3 p-3 p-sm-4 rounded">
                            <div class="mb-3">
                                <label for="name" class="form-label">場所名@required()</label>
                                @include('admin.commons.components.html.text', [
                                    'id' => 'name',
                                    'fieldName' => 'name',
                                    'default' => $place->name,
                                    'maxLength' => 100,
                                    'placeholder' => '例】寝屋川公園',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="court-surface" class="form-label">コートサーフェス</label>
                                @include('admin.commons.components.html.text', [
                                    'id' => 'court-surface',
                                    'fieldName' => 'court_surface',
                                    'default' => $place->court_surface,
                                    'maxLength' => 100,
                                    'placeholder' => '例】オムニコート',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="official-site-url" class="form-label">ホームページURL</label>
                                @include('admin.commons.components.html.text', [
                                    'id' => 'official-site-url',
                                    'fieldName' => 'official_site_url',
                                    'default' => $place->official_site_url,
                                    'maxLength' => 250,
                                    'placeholder' => '例】http://neyagawa.osaka-park.or.jp/',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="google-map-url" class="form-label">
                                    GoogleマップのURL
                                    <i class="lni lni-question-circle align-middle" role="button" data-bs-toggle="modal" data-bs-target="#google-map-guide-modal"></i>
                                </label>
                                @include('admin.commons.components.html.text', [
                                    'id' => 'google-map-url',
                                    'fieldName' => 'google_map_url',
                                    'default' => $place->google_map_url,
                                    'maxLength' => 250,
                                    'placeholder' => '例】https://goo.gl/maps/cGLxNvYxcpLikzFD7',
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border border-3 p-3 p-sm-4 rounded h-100">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="hidden" name="delete_image" value="0">
                                    <label for="file" class="form-label">画像</label>
                                    <input id="file" type="file" class="dropify" name="file" data-default-file="@if($place->image_path){{ $place->imageUrl() }}@endif" data-max-file-size="{{ config('admin.place.image.max_sizes.gb') }}G" data-allowed-file-extensions="{{ str_replace(',', ' ', config('admin.place.image.allowed_extension')) }}">
                                    <small class="text-muted">※{{ str_replace(',', ', ', config('admin.place.image.allowed_extension')) }}のみ、画像サイズ{{ config('admin.place.image.max_sizes.gb') }}GBまで</small><br>
                                    <small class="text-muted">※画像は縦{{ config('admin.place.image.dimensions.height') }}px ×横{{ config('admin.place.image.dimensions.width') }}pxにリサイズされます</small>
                                    @include('admin.commons.components.html.errors', ['fieldName' => 'file'])
                                </div>
                                <div class="col-12">
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

<!-- Modal -->
<div class="modal fade" id="google-map-guide-modal" tabindex="-1" aria-labelledby="google-map-guide-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="google-map-guide-modal-label">GoogleマップのURL取得方法</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <a href="{{ config('admin.place.google_map_url') }}" target="_blank">Googleマップへ移動<i class="fa-solid fa-arrow-up-right-from-square ms-1"></i></a>
                </div>
                <div class="mb-1">1. Googleマップで場所を検索する</div>
                <img src="/assets/admin/images/place/google-map/guide-1.png" class="w-100 border rounded mb-3" alt="">
                <div class="mb-1">2.「共有」を選択</div>
                <img src="/assets/admin/images/place/google-map/guide-2.png" class="w-100 border rounded mb-3" alt="">
                <div class="mb-1">3.「リンクをコピー」を選択</div>
                <img src="/assets/admin/images/place/google-map/guide-3.png" class="w-100 border rounded" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">とじる</button>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- dropify初期化 --}}
@include('admin.commons.components.js.dropify')
@push('scripts')
<script type="text/javascript">
$(function() {
    var fileName = null;
    var currentFileName = '{{ $place->imageFileName() }}';

    // 「削除」ボタンクリック時のイベント
    var drEvent = $('.dropify').dropify();
    // ※afterClearイベントではファイル名を取得できないので、beforeClearイベントでファイル名を変数に退避しておく
    drEvent.on('dropify.beforeClear', function(event, element){
        // 直近にセットされていたファイル名を取得
        fileName = element.file.name;
        // キャッシュ用パラメータがある場合、そのパラメータを除去
        if (fileName.indexOf("?") !== -1) {
            fileName = fileName.substring(0, fileName.indexOf("?"));
        }
    });

    // ※既存画像がある場合のみ
    drEvent.on('dropify.afterClear', function(event, element){
        if (!currentFileName) {
            return;
        }

        if (currentFileName === fileName) {
            // 既存画像プレビュー時に「削除」がクリックされた場合、削除フラグを立てる
            $('input[name="delete_image"]').val(1);
        } else {
            // 新規画像プレビュー時に「削除」がクリックされた場合、既存画像をプレビューに再セット
            var defaultFile = element.settings.defaultFile;
            element.file.name = element.cleanFilename(defaultFile);
            element.setPreview(element.isImage(), defaultFile);
        }
    });
});
</script>
@endpush
