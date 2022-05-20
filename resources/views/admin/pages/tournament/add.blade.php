@extends('admin.layouts.app')

@inject('type', 'App\ModelItems\Event\Type')

@section('content')

@php
$hours = [];
for($hour = 0; $hour <= 23; $hour++){
    $hours[$hour] = $hour;
}
$minutes = [];
for($minute = 0; $minute <= 45; $minute+=15){
    $minute = sprintf('%02d', $minute);
    $minutes[$minute] = $minute;
}
@endphp
<div class="col-sm-12 px-0">
    {{-- 要素を左右中央揃え --}}
    <div class="d-flex justify-content-center">
        <div class="x_panel px-1 px-sm-3 col-sm-6">
            <div class="x_title">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>大会新規登録</h2>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form action="{{ route('admin.tournament.create') }}" method="post">
                    @csrf
                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label" for="event-id">種目名@required()</label>
                        <select id="event-id" class="custom-select" name="event_id">
                            <option value="" data-type-id="" data-applicants="" data-entry-fee="" data-start-hour="" data-start-minutes="" @if(old('event_id', $tournament->event_id) === null) selected @endif>選択してください</option>
                            @foreach ($events as $event)
                            <option value="{{ $event->id }}" data-type-id="{{ $event->type_id }}" data-applicants="{{ $event->applicants }}" data-entry-fee="{{ $event->entry_fee }}" data-start-hour="{{ $event->start_hour }}" data-start-minutes="{{ $event->start_minutes }}" @if((string)old('event_id', $tournament->event_id) === (string)$event->id)) selected @endif>{{ $event->name }}</option>
                            @endforeach
                        </select>
                        @include('admin.commons.components.html.errors', ['fieldName' => 'event_id'])
                        <small class="text-muted">※種目名選択時に種目マスタで設定した募集数・参加費・開始時間の値が反映されます。</small>
                    </div>

                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label">場所@required()</label>
                        @include('admin.commons.components.html.select', ['fieldName' => 'place_id', 'options' => $places, 'default' => $tournament->place_id])
                    </div>

                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label">開催日@required()</label>
                        @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => $tournament->date, 'min' => today()->format('Y-m-d')])
                    </div>
                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label">開始時間@required()</label>
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.select', ['id' => 'start-hour', 'fieldName' => 'start_hour', 'options' => $hours, 'default' => $tournament->start_hour])
                            <span class="mx-1 mx-sm-2">：</span>
                            @include('admin.commons.components.html.select', ['id' => 'start-minutes', 'fieldName' => 'start_minutes', 'options' => $minutes, 'default' => $tournament->start_minutes])
                        </div>
                    </div>
                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label">募集数@required()</label>
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.number', ['id' => 'applicants', 'fieldName' => 'applicants', 'default' => $tournament->applicants])
                            <span id="applicants-unit" class="ml-2">　</span>
                        </div>
                    </div>
                    <div class="form-group mb-3 mb-sm-4">
                        <label class="col-form-label">参加費@required()</label>
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.number', ['id' => 'entry-fee', 'fieldName' => 'entry_fee', 'default' => $tournament->entry_fee])
                            <span class="ml-2">円</span>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group mb-3 mb-sm-4">
                        <div class="text-center mt-4 mt-sm-0">
                            <a href="{{ route('admin.tournament.list') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-list mr-1"></i>一覧へ</a>
                            <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function(){
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            color : '#26B99A',
            size : 'large',
        });
    });

    var attributes = [
        'type-id',
        'applicants',
        'entry-fee',
        'start-hour',
        'start-minutes',
    ];

    $("#event-id").change(function() {
        for (attribute of attributes) {
            // data属性の値を取得
            var value = $(this).find('option:selected').attr('data-' + attribute);
            $('#' + attribute).val(value);

            // 募集人数の単位切り替え
            if (attribute === 'type-id') {
                if(value === '{{ $type::SINGLES }}') {
                    $('#applicants-unit').text('人');
                } else if (value === '{{ $type::DOUBLES }}' || value === '{{ $type::MIX }}') {
                    $('#applicants-unit').text('組');
                } else {
                    $('#applicants-unit').text('　');
                }
            }
        }
    });
});
</script>
@endpush