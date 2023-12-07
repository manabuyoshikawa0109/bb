@extends('admin.layouts.app')

@push('links')
<style>
.bg-green {
    background-color: green !important;
}
.py-18 {
    padding-top: 18px;
    padding-bottom: 18px;"
}
</style>
@endpush

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">場所マスター</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.home.index') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">場所一覧</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="d-flex justify-content-between align-items-end">
    <h6 class="mb-0 text-uppercase">場所一覧</h6>
    <a href="{{ route('admin.place.add') }}" class="btn btn-dark radius-30"><i class="bx bx-plus-circle"></i>新規登録</a>
</div>
<hr/>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
    @foreach ($places as $place)
    <div class="col">
        <div class="card radius-15">
            <div class="card-body text-center">
                <div class="py-4 px-2 border radius-15">
                    <img src="{{ $place->imageUrl() }}" width="110" height="110" class="rounded-circle shadow" alt="">
                    <h5 class="text-truncate mb-0 mt-5">{{ $place->name }}</h5>
                    <p class="text-truncate mb-3">{{ $place->court_surface }}</p>
                    {{-- ホームページURL、GoogleマップのURL両方がない時は高さが出なくなるので高さ調整 --}}
                    <div class="list-inline contacts-social mt-3 mb-3 @if($place->website_url === null && $place->google_map_url === null) py-18 @endif">
                        @if ($place->website_url)
                        <a href="{{ $place->website_url }}" target="_blank" class="list-inline-item bg-google text-white border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $place->name }}のホームページを開く">
                            <i class="lni lni-home"></i>
                        </a>
                        @endif
                        @if ($place->google_map_url)
                        <a href="{{ $place->google_map_url }}" target="_blank" class="list-inline-item bg-green text-white border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $place->name }}のGoogleマップを開く">
                            <i class="lni lni-map-marker"></i>
                        </a>
                        @endif
                    </div>
                    <div class="d-grid px-4">
                        <a href="{{ route('admin.place.edit', $place->id) }}" class="btn btn-dark radius-15">編集する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--end row-->
@endsection

@include('admin.commons.components.js.tooltip')