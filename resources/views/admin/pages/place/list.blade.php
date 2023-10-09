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
                <li class="breadcrumb-item active" aria-current="page">場所マスター</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<h6 class="mb-0 text-uppercase">場所一覧</h6>
<hr/>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
    @foreach ($places as $place)
    <div class="col">
        <div class="card radius-15">
            <div class="card-body text-center">
                <div class="p-4 border radius-15">
                    <img src="{{ $place->imageUrl() }}" width="110" height="110" class="rounded-circle shadow" alt="">
                    <h5 class="mb-0 mt-5">{{ $place->name }}</h5>
                    <p class="mb-3">{{ $place->court_surface }}</p>
                    {{-- ホームページURL、GoogleマップのURL両方がない時は高さが出なくなるので高さ調整 --}}
                    <div class="list-inline contacts-social mt-3 mb-3 @if($place->official_site_url === null && $place->google_map_url === null) py-18 @endif">
                        @if ($place->official_site_url)
                        <a href="{{ $place->official_site_url }}" target="_blank" class="list-inline-item bg-google text-white border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $place->name }}のホームページを開く">
                            <i class="lni lni-home"></i>
                        </a>
                        @endif
                        @if ($place->google_map_url)
                        <a href="{{ $place->google_map_url }}" target="_blank" class="list-inline-item bg-green text-white border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $place->name }}のGoogleマップを開く">
                            <i class="lni lni-map-marker"></i>
                        </a>
                        @endif
                    </div>
                    <div class="d-grid">
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