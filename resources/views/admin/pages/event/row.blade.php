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
<tr class="even pointer">
    <td>
        @include('admin.commons.components.html.text', ['fieldName' => "events[{$i}][name]", 'default' => $event->name])
    </td>
    <td>
        @include('admin.commons.components.html.number', ['fieldName' => "events[{$i}][capacity]", 'default' => $event->capacity])
    </td>
    <td>
        <div class="d-flex align-items-center">
            @include('admin.commons.components.html.number', ['fieldName' => "events[{$i}][entry_fee]", 'default' => $event->entry_fee])
            <span class="ml-1">円</span>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            @include('admin.commons.components.html.select', ['fieldName' => "events[{$i}][start_hour]", 'options' => $hours, 'default' => $event->start_hour, 'label' => '時'])
            <span>：</span>
            @include('admin.commons.components.html.select', ['fieldName' => "events[{$i}][start_minutes]", 'options' => $minutes, 'default' => $event->start_minutes, 'label' => '分'])
        </div>
    </td>
    <td>
        <input type="checkbox" class="flat" name="is_doubles">
    </td>
    <td>
        <input type="checkbox" class="flat" name="is_mix">
    </td>
    <td>
        <input type="checkbox" class="flat" name="delete">
    </td>
</tr>
