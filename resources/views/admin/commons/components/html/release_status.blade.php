@php
use App\Enums\ReleaseStatus;
@endphp
{{-- スマホ時ステータスを横スクロールできるようにする --}}
<div class="d-flex align-items-center overflow-scroll text-nowrap mb-4">
    <label class="fw-bold me-1">ステータス：</label>
    @foreach (ReleaseStatus::cases() as $releaseStatus)
    <input type="radio" class="btn-check" name="release_status" id="release-status{{ $releaseStatus->value }}" value="{{ $releaseStatus->value }}" autocomplete="off" @if($searchParam->release_status == $releaseStatus->value) checked @endif>
    <label class="btn radius-30 me-1 @if($searchParam->release_status == $releaseStatus->value) btn-{{ $releaseStatus->colorClass() }} @else btn-outline-{{ $releaseStatus->colorClass() }} @endif" for="release-status{{ $releaseStatus->value }}">{{ $releaseStatus->name() }}</label>
    @endforeach
</div>

@push('scripts')
<script type="text/javascript">
$(function(){
    // ステータス選択時即時検索実行
    $('input[name="release_status"]').change(function(){
        $(this).closest('form').submit();
    });
});
</script>
@endpush