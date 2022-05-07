{{--
    チェックボックスコンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $value : チェックボックスの値(int型にする)
    $default : デフォルト値
    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
@endphp
    {{-- チェックされなかった際のデフォルト値 --}}
    <input type="hidden" name="{{ $fieldName }}" value="0">
    <input id="{{ $id ?? null }}" type="checkbox" class="{{ $class ?? null }}" name="{{ $fieldName }}" value="{{ $value ?? 1 }}" @if((int)old($name, $default ?? null) === ($value ?? 1)) checked @endif>
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
