{{--
    テキストボックスコンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $maxLength :　最大文字数
    $placeholder : プレースホルダー
    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
@endphp
    <input id="{{ $id ?? null }}" type="text" class="form-control {{ $class ?? null }}" name="{{ $fieldName }}" value="{{ old($name, $default ?? null) }}" maxlength="{{ $maxLength ?? null }}" placeholder="{{ $placeholder ?? null }}">
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
