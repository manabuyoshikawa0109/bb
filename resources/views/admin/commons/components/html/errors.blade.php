{{--
    エラーメッセージ表示コンポーネント
    $fieldName : name属性
--}}
@if ($errors->has($fieldName))
    @foreach ($errors->get($fieldName) as $error)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $error }}</strong>
        </span>
    @endforeach
@endif
