{{--
    セレクトボックスコンポーネント
    $fieldName : name属性
    $options : 選択肢
    $class : クラス名
    $default : デフォルト値
    $label : ラベル名
    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName, $options)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
@endphp

<select id="" class="custom-select {{ $class ?? null }}" name="{{ $fieldName }}">
    <option value="" @if(old($name, $default ?? null) === null) selected @endif>{{ $label ?? '選択してください' }}</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" @if((string)old($name, $default ?? null) === (string)$key)) selected @endif>{{ $value }}</option>
    @endforeach
</select>
@include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
