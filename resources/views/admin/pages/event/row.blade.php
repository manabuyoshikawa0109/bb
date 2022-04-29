@php
$no = $event->id ?? '@no@';
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
<tr>
    <td>
        <input type="hidden" name="events[{{$no}}][id]" value="{{ $no }}">
        @include('admin.commons.components.html.text', ['fieldName' => "events[{$no}][name]", 'default' => $event->name])
    </td>
    <td>
        @include('admin.commons.components.html.number', ['fieldName' => "events[{$no}][applicants]", 'default' => $event->applicants])
    </td>
    <td>
        <div class="d-flex align-items-center">
            @include('admin.commons.components.html.number', ['fieldName' => "events[{$no}][entry_fee]", 'default' => $event->entry_fee])
            <span class="ml-1">円</span>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            @include('admin.commons.components.html.select', ['fieldName' => "events[{$no}][start_hour]", 'options' => $hours, 'default' => $event->start_hour, 'label' => '時'])
            <span>：</span>
            @include('admin.commons.components.html.select', ['fieldName' => "events[{$no}][start_minutes]", 'options' => $minutes, 'default' => $event->start_minutes, 'label' => '分'])
        </div>
    </td>
    <td>
        <input type="hidden" name="events[{{$no}}][is_doubles]" value="0">
        @include('admin.commons.components.html.checkbox', ['fieldName' => "events[{$no}][is_doubles]", 'class' => 'icheck-blue', 'default' => $event->is_doubles])
    </td>
    <td>
        <input type="hidden" name="events[{{$no}}][is_mix]" value="0">
        @include('admin.commons.components.html.checkbox', ['fieldName' => "events[{$no}][is_mix]", 'class' => 'icheck-blue', 'default' => $event->is_mix])
    </td>
    <td>
        {{-- イベントIDが正の数=DBに登録されているのでチェックボックスを表示 --}}
        @if(0 < $event->id)
            @include('admin.commons.components.html.checkbox', ['fieldName' => "events[{$no}][delete]", 'class' => 'icheck-red'])
        @else
            {{-- ajaxで削除する為のクラス名を付与（仮実装） --}}
            <i class="fas fa-trash-alt @if(0 < $event->id) ajax-delete @endif" data-id="{{ $event->id }}"></i>
        @endif
    </td>
</tr>
