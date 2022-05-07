@extends('admin.layouts.app')

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
<div class="col-md-12 col-sm-12 px-0">
    <div class="x_panel px-1 px-sm-3">
        <div class="x_title">
            <div class="d-flex justify-content-between align-items-center">
                <h2>大会新規登録</h2>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form action="{{ route('admin.tournament.create') }}" method="post">
                @csrf
                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align" for="event-id">
                        種目名@required()
                    </label>
                    <div class="col-sm-6">
                        <select id="event-id" class="custom-select" name="event_id">
                            <option value="" data-applicants="" data-entry-fee="" data-start-hour="" data-start-minutes="" data-is-doubles="" data-is-mix="" @if(old('event_id', $tournament->event_id) === null) selected @endif>選択してください</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" data-applicants="{{ $event->applicants }}" data-entry-fee="{{ $event->entry_fee }}" data-start-hour="{{ $event->start_hour }}" data-start-minutes="{{ $event->start_minutes }}" data-is-doubles="{{ $event->is_doubles }}" data-is-mix="{{ $event->is_mix }}" @if((string)old('event_id', $tournament->event_id) === (string)$event->id)) selected @endif>{{ $event->name }}</option>
                            @endforeach
                        </select>
                        @include('admin.commons.components.html.errors', ['fieldName' => 'event_id'])
                        <small class="text-muted">※種目名選択時に開始時間・募集数・参加費・ダブルス・ミックスのデフォルト値が反映されます。</small>
                    </div>
                </div>

                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align">
                        場所@required()
                    </label>
                    <div class="col-sm-6">
                        @include('admin.commons.components.html.select', ['fieldName' => 'place_id', 'options' => $places, 'default' => $tournament->place_id])
                    </div>
                </div>

                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align">
                        開催日@required()
                    </label>
                    <div class="col-sm-6">
                        @include('admin.commons.components.html.date', ['fieldName' => 'date', 'default' => $tournament->date, 'min' => today()->format('Y-m-d')])
                    </div>
                </div>
                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align">
                        開始時間@required()
                    </label>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.select', ['id' => 'start-hour', 'fieldName' => 'start_hour', 'options' => $hours, 'default' => $tournament->start_hour])
                            <span class="mx-1 mx-sm-2">：</span>
                            @include('admin.commons.components.html.select', ['id' => 'start-minutes', 'fieldName' => 'start_minutes', 'options' => $minutes, 'default' => $tournament->start_minutes])
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align">
                        募集数@required()
                    </label>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.number', ['id' => 'applicants', 'fieldName' => 'applicants', 'default' => $tournament->applicants])
                            <span id="applicants-unit" class="ml-2">　</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3 mb-sm-4">
                    <label class="col-form-label col-sm-3 label-align">
                        参加費@required()
                    </label>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            @include('admin.commons.components.html.number', ['id' => 'entry-fee', 'fieldName' => 'entry_fee', 'default' => $tournament->entry_fee])
                            <span class="ml-2">円</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3 mb-sm-4 align-items-center">
                    <label class="col-form-label col-sm-3 label-align">
                        ダブルス
                    </label>
                    <div class="col-sm-6">
                        @include('admin.commons.components.html.checkbox', ['id' => 'is-doubles', 'fieldName' => 'is_doubles', 'class' => 'switchery', 'default' => $tournament->is_doubles])
                    </div>
                </div>

                <div class="form-group row mb-3 mb-sm-4 align-items-center">
                    <label class="col-form-label col-sm-3 label-align">
                        ミックス
                    </label>
                    <div class="col-sm-6">
                        @include('admin.commons.components.html.checkbox', ['id' => 'is-mix', 'fieldName' => 'is_mix', 'class' => 'switchery', 'default' => $tournament->is_mix])
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group row mb-3 mb-sm-4">
                    <div class="col-sm-12">
                        <div class="text-center mt-4 mt-sm-0">
                            <a href="{{ route('admin.tournament.list') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-list mr-1"></i>一覧へ</a>
                            <button type="submit" class="btn btn-dark"><i class="fas fa-save mr-1"></i>登録する</button>
                        </div>
                    </div>
                </div>
            </form>
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
        'applicants',
        'entry-fee',
        'start-hour',
        'start-minutes',
        'is-doubles',
        'is-mix'
    ];

    $("#event-id").change(function() {
        for (attribute of attributes) {
            // data属性の値を取得
            var value = $(this).find('option:selected').attr('data-' + attribute);

            // デフォルト値のセット
            // 参考：https://github.com/abpetkov/switchery/issues/25
            if (attribute === 'is-doubles' || attribute === 'is-mix') {
                if(value === '1') {
                    $('#' + attribute).prop('checked', true);
                    $('#' + attribute).parent().find('.switchery').trigger('click');
                } else {
                    $('#' + attribute).prop('checked', false);
                    $('#' + attribute).parent().find('.switchery').trigger('click');
                }
            } else {
                $('#' + attribute).val(value);
            }

            // 募集人数の単位切り替え
            if (attribute === 'is-doubles') {
                if(value === '1') {
                    $('#applicants-unit').text('組');
                } else if (value === '0') {
                    $('#applicants-unit').text('人');
                } else {
                    $('#applicants-unit').text('　');
                }
            }
        }
    });
});
</script>
@endpush
