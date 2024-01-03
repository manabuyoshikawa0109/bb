{{--
    テキストエリアコンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $maxLength : 最大文字数
    $placeholder : プレースホルダー
    $rows : テキストエリアの高さ
--}}

@isset($fieldName)
    <textarea id="{{ $id ?? null }}" name="{{ $fieldName }}" class="form-control {{ $class ?? null }}" placeholder="{{ $placeholder ?? null }}" maxlength="{{ $maxLength ?? null }}" rows="{{ $rows ?? 2 }}">{{ old($fieldName, $default ?? null) }}</textarea>
    @include('admin.commons.components.html.errors', ['fieldName' => $fieldName])
@endisset
