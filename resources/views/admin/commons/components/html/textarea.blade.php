{{--
    テキストエリアコンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $maxLength :　最大文字数
    $placeholder : プレースホルダー（特殊文字をエスケープせず表示）
    $rows : テキストエリアの高さ
    $name : $fieldNameをドット記法に変更したもの
--}}

@isset($fieldName)
@php
// name属性が配列になっている場合に備えドット記法に変更
$name = str_replace('[', '.', $fieldName);
$name = str_replace(']', '', $name);
@endphp
    <textarea id="{{ $id ?? null }}" name="{{ $fieldName }}" class="form-control {{ $class ?? null }}" placeholder="{!! $placeholder ?? null !!}" maxlength="{{ $maxLength ?? null }}" rows="{{ $rows ?? 2 }}">{{ old($fieldName, $default ?? '') }}</textarea>
    @include('admin.commons.components.html.errors', ['fieldName' => $name])
@endisset
