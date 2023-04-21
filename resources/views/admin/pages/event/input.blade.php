@extends('admin.layouts.app')

@php
use App\Enums\Event\Type;
use App\Enums\Event\ApplicableSex;
@endphp

@push('links')
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4">
    @if ($event->exists)
    <span class="text-muted fw-light">種目マスタ / 一覧画面 /</span> 編集画面
    @else
    <span class="text-muted fw-light">種目マスタ / </span> 新規登録画面
    @endif
</h4>

<div class="row">
    <div class="col-md-12">
        <form action="{{ $event->exists ? route('admin.event.update', $event->id) : route('admin.event.create') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <h5 class="card-header">種目詳細設定</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">種目名@required()</label>
                                @include('admin.commons.components.html.text', ['id' => 'name', 'fieldName' => "name", 'default' => $event->name, 'maxLength' => 100, 'placeholder' => '例】初級男子シングルス'])
                            </div>
                            <div class="mb-3 pt-2">
                                <small class="d-block">種別@required()</small>
                                @foreach (Type::cases() as $type)
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="type" id="type-{{ $type->value }}" value="{{ $type->value }}" @if($type->value == optional($event->type)->value) checked @endif>
                                    <label class="form-check-label" for="type-{{ $type->value }}">{{ $type->name() }}</label>
                                </div>
                                @endforeach
                                @include('admin.commons.components.html.errors', ['fieldName' => 'type'])
                            </div>
                            <div class="mb-3 pt-2">
                                <small class="d-block">申し込み可能な性別@required()</small>
                                @foreach (ApplicableSex::cases() as $applicableSex)
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="applicable_sex" id="applicable-sex-{{ $applicableSex->value }}" value="{{ $applicableSex->value }}" @if($applicableSex->value == optional($event->applicable_sex)->value) checked @endif>
                                    <label class="form-check-label" for="applicable-sex-{{ $applicableSex->value }}">{{ $applicableSex->name() }}</label>
                                </div>
                                @endforeach
                                @include('admin.commons.components.html.errors', ['fieldName' => 'applicable_sex'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="applicants" class="form-label">募集数
                                    <i class="fa-regular fa-circle-question fa-lg ms-1"
                                    data-bs-toggle="popover"
                                    data-bs-offset="0,14"
                                    data-bs-placement="top"
                                    data-bs-html="true"
                                    data-bs-content="<p>大会管理にて新規登録時、この種目名を選択するとここで登録した募集数が自動で反映されます。</p> <div class='d-flex justify-content-end'><button type='button' class='btn btn-sm btn-outline-secondary close-popover'>とじる</button></div>"
                                    role="button">
                                    </i>
                                </label>
                                <div class="input-group">
                                    <input id="applicants" type="number" class="form-control" name="applicants" value="{{ old('applicants', $event->applicants) }}" maxlength="" placeholder="18">
                                    <span id="applicants-unit" class="input-group-text">{!! optional($event->type)->unit() ?? '&emsp;' !!}</span>
                                </div>
                                @include('admin.commons.components.html.errors', ['fieldName' => 'applicants'])
                            </div>
                            <div class="mb-3">
                                <label for="entry-fee" class="form-label">参加費
                                    <i class="fa-regular fa-circle-question fa-lg ms-1"
                                    data-bs-toggle="popover"
                                    data-bs-offset="0,14"
                                    data-bs-placement="top"
                                    data-bs-html="true"
                                    data-bs-content="<p>大会管理にて新規登録時、この種目名を選択するとここで登録した参加費が自動で反映されます。</p> <div class='d-flex justify-content-end'><button type='button' class='btn btn-sm btn-outline-secondary close-popover'>とじる</button></div>"
                                    role="button">
                                    </i>
                                </label>
                                <div class="input-group">
                                    <input id="entry-fee" type="number" class="form-control" name="entry_fee" value="{{ old('entry_fee', $event->entry_fee) }}" maxlength="5" placeholder="5000">
                                    <span class="input-group-text">円</span>
                                </div>
                                @include('admin.commons.components.html.errors', ['fieldName' => 'entry_fee'])
                            </div>
                            <div class="mb-3">
                                <label for="held-time" class="form-label">開催時間
                                    <i class="fa-regular fa-circle-question fa-lg ms-1"
                                    data-bs-toggle="popover"
                                    data-bs-offset="0,14"
                                    data-bs-placement="top"
                                    data-bs-html="true"
                                    data-bs-content="<p>大会管理にて新規登録時、この種目名を選択するとここで登録した開催時間が自動で反映されます。</p> <div class='d-flex justify-content-end'><button type='button' class='btn btn-sm btn-outline-secondary close-popover'>とじる</button></div>"
                                    role="button">
                                    </i>
                                </label>
                                <input id="held-time" type="time" name="held_time" class="form-control" value="{{ $event->held_time }}">
                                @include('admin.commons.components.html.errors', ['fieldName' => 'held_time'])
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2"><i class='bx bx-save me-1'></i>{{ $event->exists ? '更新する' : '登録する' }}</button>
                        <a href="{{ route('admin.event.list') }}" class="btn btn-outline-secondary"><i class='bx bx-list-ul me-1'></i>一覧に戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@php
$types = [];
foreach (Type::cases() as $type) {
    $types[$type->value] = $type->unit();
}
@endphp

@push('scripts')
<script type="text/javascript">
$(function() {
    $('input[name="type"]').change( function() {
        var value = $(this).val();
        var types = @json($types);
        var unit = types[value];
        $('#applicants-unit').text(unit);
    });
});
</script>
@endpush
