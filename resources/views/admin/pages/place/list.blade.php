@extends('admin.layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">場所マスタ /</span> 一覧画面</h4>

<div class="row mb-5">
    @foreach($places as $place)
    <div class="col-lg-6">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="card-img card-img-left h-100" src="{{ $place->imageUrl() }}" alt="{{ $place->name }}" />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $place->name }}</h5>
                            <div class="card-title">
                                @if($place->google_map_url)
                                <a href="{{ $place->google_map_url }}" target="_blank" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="{{ $place->name }}のGoogleマップへ移動">
                                    <i class="bx bx-map bx-sm"></i>
                                </a>
                                @endif
                                @if($place->official_site_url)
                                <a href="{{ $place->official_site_url }}" target="_blank" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="{{ $place->name }}のホームページへ移動">
                                    <i class="bx bx-home-circle bx-sm"></i>
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.place.edit', $place->id) }}" class="btn btn-outline-primary me-2">
                                <i class="bx bx-edit-alt me-1"></i>編集する
                            </a>
                            <form action="{{ route('admin.place.delete', $place->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger delete-btn">
                                    <i class="bx bx-trash me-1"></i>削除する
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    $('.delete-btn').click(function() {
        if (!confirm("場所情報の削除\r\n削除後は復元することができませんがよろしいですか？")) {
            return false;
        }
    });
});
</script>
@endpush