@extends('admin.layouts.app')

@push('links')
<link href="/assets/plugins/filepond/filepond.min.css" rel="stylesheet">
<link href="/assets/plugins/filepond/filepond-plugin-image-preview.min.css" rel="stylesheet">
<style>
.filepond--root {
    margin-bottom: 0 !important;
}
</style>
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4">
    @if($place->exists)
    <span class="text-muted fw-light">場所マスタ / 一覧画面 /</span> 編集画面
    @else
    <span class="text-muted fw-light">場所マスタ / </span> 新規登録画面
    @endif
</h4>

<div class="row">
    <div class="col-md-12">
        <form action="{{ $place->exists ? route('admin.place.update', $place->id) : route('admin.place.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-sm-flex align-items-center gap-4">
                        <div class="col-md-4 col-lg-3">
                            <input type="hidden" name="path" value="{{ $place->image_path }}">
                            <input type="file" class="filepond" name="file">
                        </div>
                        <div class="mt-2 mt-sm-0">
                            <p class="text-muted mb-1">※{{ str_replace(',', ', ', config('admin.place.image.allowed_extension')) }}のみ、ファイルサイズ{{ config('admin.place.image.max_sizes.gb') }}GBまで</p>
                            <p class="text-muted mb-0">※画像は縦{{ config('admin.place.image.dimensions.height') }}px × 横{{ config('admin.place.image.dimensions.width') }}pxにリサイズされます</p>
                        </div>
                    </div>
                    @include('admin.commons.components.html.errors', ['fieldName' => 'file'])
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">場所名@required()</label>
                            @include('admin.commons.components.html.text', ['id' => 'name', 'fieldName' => "name", 'default' => $place->name, 'maxLength' => 100, 'placeholder' => '例】寝屋川公園'])
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="officialSiteUrl" class="form-label">公式サイトURL</label>
                            @include('admin.commons.components.html.text', ['id' => 'officialSiteUrl', 'fieldName' => "official_site_url", 'default' => $place->official_site_url, 'maxLength' => 250, 'placeholder' => '例】http://neyagawa.osaka-park.or.jp/'])
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="googleMapUrl" class="form-label">GoogleマップのURL<i class="fa-regular fa-circle-question fa-lg ms-1" data-bs-toggle="modal" data-bs-target="#googleMapGuideModal" role="button"></i></label>
                            @include('admin.commons.components.html.text', ['id' => 'googleMapUrl', 'fieldName' => "google_map_url", 'default' => $place->google_map_url, 'maxLength' => 250, 'placeholder' => '例】https://goo.gl/maps/cGLxNvYxcpLikzFD7'])
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2"><i class='bx bx-save me-1'></i>{{ $place->exists ? '更新する' : '登録する' }}</button>
                        <a href="{{ route('admin.place.list') }}" class="btn btn-outline-secondary"><i class='bx bx-list-ul me-1'></i>一覧に戻る</a>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="googleMapGuideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="googleMapGuideModalLabel">GoogleマップのURL取得方法</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1"><a href="{{ config('admin.place.google_map_url') }}" target="_blank">Googleマップへ移動<i class="fa-solid fa-arrow-up-right-from-square ms-1"></i></a></div>
                <div class="mb-1">1. Googleマップで場所を検索する</div>
                <img src="/assets/admin/images/place/google-map/guide1.png" class="w-100 border rounded mb-3" alt="">
                <div class="mb-1">2.「共有」を選択</div>
                <img src="/assets/admin/images/place/google-map/guide2.png" class="w-100 border rounded mb-3" alt="">
                <div class="mb-1">3.「リンクをコピー」を選択</div>
                <img src="/assets/admin/images/place/google-map/guide3.png" class="w-100 border rounded" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    とじる
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/assets/plugins/filepond/filepond.min.js"></script>
<script src="/assets/plugins/filepond/filepond.jquery.js"></script>
<script src="/assets/plugins/filepond/filepond-plugin-image-preview.min.js"></script>
<script src="/assets/plugins/filepond/filepond-plugin-file-validate-size.min.js"></script>
<script src="/assets/plugins/filepond/filepond-plugin-file-validate-type.min.js"></script>
<script type="text/javascript">
$(function() {
    $.fn.filepond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
    );

    @php
    // filepondで許容する拡張子を指定できるようデータ加工
    function addImagePrefix(string $extension)
    {
        return "image/{$extension}";
    }
    $extensions = array_map('addImagePrefix', explode(",", config('admin.place.image.allowed_extension')));
    @endphp

    {{-- filepondの初期化 --}}
    $('.filepond').filepond({
        labelIdle: '<span class="filepond--label-action">画像をドラッグ&ドロップ、<br>もしくは選択</span>', // ラベル名
        credits: false, // 広告を消す
        imagePreviewHeight: 150, // 画像プレビューの高さ(固定)
        stylePanelLayout: 'compact', // レイアウトモード(compactはpaddingを消すモード)
        storeAsFile: true, // ファイル情報をhiddenで持ってpost送信できるようにするか
        maxFileSize: '{{ config('admin.place.image.max_sizes.kb') }}KB',
        labelMaxFileSizeExceeded: '画像サイズが大きすぎます',
        labelMaxFileSize: '最大ファイルサイズは{{ config('admin.place.image.max_sizes.gb') }}GBです',
        acceptedFileTypes: @json($extensions),
        labelFileTypeNotAllowed: '拡張子に不備があります',
        fileValidateTypeLabelExpectedTypes: '{{ str_replace(',', ', ', config('admin.place.image.allowed_extension')) }}のみ使用可能',
    });

    {{-- 画像登録時はデフォルトで表示 --}}
    @if($place->image_path && !$errors->has('file'))
    $('.filepond').filepond('addFile', '{{ $place->imageUrl() }}');
    @endif

    {{-- 画像削除時のイベント --}}
    $('.filepond').on('FilePond:removefile', function (e) {
        $('input[name="path"]').val('');
    });
});
</script>
@endpush
