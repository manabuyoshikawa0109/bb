{{--
    チェックボックスコンポーネント
    $fieldName : name属性
    $class : クラス名
    $value : チェックボックスの値
    $default : デフォルト値
    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
info($name);
@endphp
    <input id="" type="checkbox" class="{{ $class ?? null }}" name="{{ $fieldName }}" value="{{ $value ?? 1 }}" @if(old($name, $default ?? null) === ($value ?? 1)) checked @endif>
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
