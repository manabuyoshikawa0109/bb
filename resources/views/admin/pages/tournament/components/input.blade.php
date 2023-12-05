@inject('type', 'App\ModelItems\Event\Type')

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

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label" for="event-id">種目名@required()</label>
    <select id="event-id" class="custom-select" name="event_id">
        <option value="" data-type-id="" data-capacity="" data-participation-fee="" data-start-hour="" data-start-minutes="" @if(old('event_id', $tournament->event_id) === null) selected @endif>選択してください</option>
        @foreach ($events as $event)
        <option value="{{ $event->id }}" data-type-id="{{ $event->type_id }}" data-capacity="{{ $event->capacity }}" data-participation-fee="{{ $event->participation_fee }}" data-start-hour="{{ $event->start_hour }}" data-start-minutes="{{ $event->start_minutes }}" @if((string)old('event_id', $tournament->event_id) === (string)$event->id)) selected @endif>{{ $event->name }}</option>
        @endforeach
    </select>
    @include('admin.commons.components.html.errors', ['fieldName' => 'event_id'])
    @if($tournament->exists === false)
        <small class="text-muted">※種目名選択時に種目マスタで設定した募集数・参加費・開始時間の値が反映されます。</small>
    @endif
</div>

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">場所@required()</label>
    @include('admin.commons.components.html.select', ['fieldName' => 'place_id', 'options' => $places, 'default' => $tournament->place_id])
</div>

<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">開催日@required()</label>
    @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => optional($tournament->date)->format('Y-m-d')])
</div>
<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">開始時間@required()</label>
    <div class="d-flex align-items-center">
        <div class="col px-0">
            @include('admin.commons.components.html.select', ['id' => 'start-hour', 'fieldName' => 'start_hour', 'options' => $hours, 'default' => $tournament->start_hour])
        </div>
        <span class="col-1 text-center px-0">：</span>
        <div class="col px-0">
            @include('admin.commons.components.html.select', ['id' => 'start-minutes', 'fieldName' => 'start_minutes', 'options' => $minutes, 'default' => $tournament->start_minutes])
        </div>
    </div>
</div>
<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">募集数@required()</label>
    <div class="d-flex align-items-center">
        <div class="col px-0">
            @include('admin.commons.components.html.number', ['id' => 'capacity', 'fieldName' => 'capacity', 'default' => $tournament->capacity, 'placeholder' => '例】20'])
        </div>
        <span id="capacity-unit" class="ml-2">{{ $tournament->capacityUnit() }}</span>
    </div>
</div>
<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">参加費@required()</label>
    <div class="d-flex align-items-center">
        <div class="col px-0">
            @include('admin.commons.components.html.number', ['id' => 'participation-fee', 'fieldName' => 'participation_fee', 'default' => $tournament->participation_fee, 'placeholder' => '例】5000'])
        </div>
        <span class="ml-2">円</span>
    </div>
</div>
<div class="form-group mb-3 mb-sm-4">
    <label class="col-form-label">状態</label>
    <div class="col px-0">
        @include('admin.commons.components.html.checkbox', ['fieldName' => 'status_id', 'class' => 'switchery', 'default' => $tournament->status_id])
    </div>
</div>

{{-- switcheryの初期化 --}}
@include('admin.commons.components.js.switchery')

@push('scripts')
<script type="text/javascript">
$(function(){
    var units = @json($type::$units);
    // 種目の種別毎に募集人数の単位の切り替えを行う
    $("#event-id").change(function() {
        // data属性の値を取得
        var value = $(this).find('option:selected').attr('data-type-id');
        var unit = '　';
        if(units[value]) {
            unit = units[value];
        }
        $('#capacity-unit').text(unit);
    });
});
</script>
@endpush
