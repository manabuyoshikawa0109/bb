@inject('type', 'App\ModelItems\Event\Type')

@php
$id = $event->id ?? '@id@';
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
        @include('admin.commons.components.html.text', ['id' => null, 'fieldName' => "events[{$id}][name]", 'class' => 'event-name', 'default' => $event->name])
    </td>
    <td>
        @include('admin.commons.components.html.select', ['id' => null, 'fieldName' => "events[{$id}][type_id]", 'options' => $type::$items, 'default' => $event->type_id])
    </td>
    <td>
        @include('admin.commons.components.html.number', ['id' => null, 'fieldName' => "events[{$id}][applicants]", 'default' => $event->applicants])
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div>
                @include('admin.commons.components.html.number', ['id' => null, 'fieldName' => "events[{$id}][entry_fee]", 'default' => $event->entry_fee])
            </div>
            <span class="ml-1">円</span>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div>
                @include('admin.commons.components.html.select', ['id' => null, 'fieldName' => "events[{$id}][start_hour]", 'options' => $hours, 'default' => $event->start_hour, 'label' => '時'])
            </div>
            <span>：</span>
            <div>
                @include('admin.commons.components.html.select', ['id' => null, 'fieldName' => "events[{$id}][start_minutes]", 'options' => $minutes, 'default' => $event->start_minutes, 'label' => '分'])
            </div>
        </div>
    </td>
    <td>
        {{-- イベントIDが正の数=DBに登録されているのでチェックボックスを表示 --}}
        @if($event->id && 0 < $event->id)
            @include('admin.commons.components.html.checkbox', ['id' => null, 'fieldName' => "events[{$id}][delete]", 'class' => 'icheck-red'])
        @else
            {{-- ajaxで削除する為のクラス名を付与（仮実装） --}}
            <i class="fas fa-trash-alt @if($event->id && 0 < $event->id) ajax-delete @endif" data-id="{{ $event->id }}"></i>
        @endif
    </td>
</tr>
