{{--
    テキストボックスコンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $maxLength : 最大文字数
    $placeholder : プレースホルダー
--}}

@isset($fieldName)
    <input id="{{ $id ?? null }}" type="text" class="form-control {{ $class ?? null }}" name="{{ $fieldName }}" value="{{ old($fieldName, $default ?? null) }}" maxlength="{{ $maxLength ?? null }}" placeholder="{{ $placeholder ?? null }}">
    @include('admin.commons.components.html.errors', ['fieldName' => $fieldName])
@endisset
