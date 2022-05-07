{{--
    日付入力コンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $min : 入力できる最小値
    $max : 入力できる最大値

    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
@endphp
    <input id="{{ $id ?? null }}" type="date" class="form-control {{ $class ?? null }}" name="{{ $fieldName }}" value="{{ old($name, $default ?? today()->format('Y-m-d')) }}"　min="{{ $min ?? null }}" max="{{ $max ?? null }}">
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
