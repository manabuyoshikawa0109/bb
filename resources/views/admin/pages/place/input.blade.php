@extends('admin.layouts.app')

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
        <div class="card mb-4">
            <!-- Account -->
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img
                    src="{{ $place->imageUrl() }}"
                    alt="user-avatar"
                    class="d-block rounded"
                    height="100"
                    width="150"
                    id="uploadedAvatar"
                    />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            accept="image/png, image/jpeg"
                            />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ $place->exists ? route('admin.place.update', $place->id) : route('admin.place.create') }}" method="POST">
                    @csrf
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
                </form>
            </div>
            <!-- /Account -->
        </div>
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
