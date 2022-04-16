{{--
    数値入力コンポーネント
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

    <input id="" type="number" class="form-control @if($agent->isDesktop()) form-control-sm @endif {{ $class ?? null }}" name="{{ $fieldName }}" value="{{ old($name, $default ?? null) }}" maxlength="{{ $maxLength ?? null }}" placeholder="{{ $placeholder ?? null }}">
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
