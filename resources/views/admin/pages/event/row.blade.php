@php
use Illuminate\Support\Str;
use App\Enums\Event\Type;

// 行新規追加時に変数を渡さなくて良いよう2項演算子を使用
// 英数字ランダムの文字列は15文字でほぼ重複が発生しない
// 参考：https://qiita.com/daikikatsuragawa/items/27688f01c9c525a8af01
$key = $key ?? Str::random(15);
$event = $event ?? [];
$id = data_get($event, 'id');
$name = data_get($event, 'name');
$type = data_get($event, 'type');
$capacity = data_get($event, 'capacity');
$participationFee = data_get($event, 'participation_fee');
$startTime = data_get($event, 'start_time');
// 行追加時$typeはnullとなりEnumのcaseを取得できない為、tryfromを用いマッチしない際はnullを返す
$unit = '&emsp;';
if ($type && Type::tryfrom($type)){
    $unit = Type::tryfrom($type)->unit();
}
@endphp
<tr>
    <input type="hidden" name="events[{{ $key }}][id]" value="{{ $id }}">
    <td>
        <select class="form-control type-select" name="events[{{ $key }}][type]">
            <option value="" data-unit="&emsp;" @if(old("events.{$key}.type", $type) == null) selected @endif>選択してください</option>
            @foreach (Type::cases() as $typeMaster)
                <option value="{{ $typeMaster->value }}" data-unit="{{ $typeMaster->unit() }}" @if(old("events.{$key}.type", $type) == $typeMaster->value) selected @endif>{{ $typeMaster->name() }}</option>
            @endforeach
        </select>
        @include('admin.commons.components.html.errors', ['fieldName' => "events.{$key}.type"])
    </td>
    <td>
        <input type="text" class="form-control name-input" name="events[{{ $key }}][name]" value="{{ $name }}" maxlength="100" placeholder="初級男子シングルス">
        @include('admin.commons.components.html.errors', ['fieldName' => "events.{$key}.name"])
    </td>
    <td>
        <div class="input-group">
            <input type="number" class="form-control" name="events[{{ $key }}][capacity]" value="{{ $capacity }}" placeholder="18" min="0" aria-describedby="event-capacity-unit{{ $key }}"><span class="input-group-text" id="event-capacity-unit{{ $key }}">{!! $unit !!}</span>
        </div>
        @include('admin.commons.components.html.errors', ['fieldName' => "events.{$key}.capacity"])
    </td>
    <td>
        <div class="input-group">
            <input type="number" class="form-control" name="events[{{ $key }}][participation_fee]" value="{{ $participationFee }}" placeholder="5000" min="0" max="99999" aria-describedby="event-participation-fee-unit{{ $key }}"><span class="input-group-text" id="event-participation-fee-unit{{ $key }}">円</span>
        </div>
        @include('admin.commons.components.html.errors', ['fieldName' => "events.{$key}.participation_fee"])
    </td>
    <td>
        <input type="time" class="form-control" name="events[{{ $key }}][start_time]" value="{{ $startTime }}">
        @include('admin.commons.components.html.errors', ['fieldName' => "events.{$key}.start_time"])
    </td>
    <td>
        <div class="d-flex order-actions">
            <a href="javascript:;"><i class="bx bxs-trash"></i></a>
        </div>
    </td>
</tr>
