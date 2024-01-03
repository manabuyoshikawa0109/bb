{{--
    日付入力コンポーネント
    $id : id属性
    $fieldName : name属性
    $class : クラス名
    $default : デフォルト値
    $min : 入力可能な最小日付(Y-m-dの形式)
    $max : 入力可能な最大日付(Y-m-dの形式)
--}}

@isset($fieldName)
    <input id="{{ $id ?? null }}" type="date" class="form-control {{ $class ?? null }}" name="{{ $fieldName }}" value="{{ old($fieldName, $default ?? null) }}" min="{{ $min ?? null }}" max="{{ $max ?? null }}">
    @include('admin.commons.components.html.errors', ['fieldName' => $fieldName])
@endisset
