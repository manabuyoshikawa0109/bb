@extends('admin.layouts.base')

@section('body_class', 'login')

@push('links')
<link rel="stylesheet" type="text/css" href="/assets/plugins/animate/animate.css">
<link rel="stylesheet" type="text/css" href="/assets/plugins/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="/assets/plugins/animsition/css/animsition.min.css">
<!-- <link rel="stylesheet" type="text/css" href="/assets/plugins/select2/select2.min.css"> -->
<link rel="stylesheet" type="text/css" href="/assets/plugins/linearicons/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="/assets/admin/css/login.css?{{ now()->format('YmdHis') }}">
@endpush

@section('inner_body')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(/assets/admin/images/tennis.jpeg);">
                <span class="login100-form-title-1">
                    BBテニス<br>管理サイト
                </span>
            </div>

            <form class="login100-form validate-form" action="{{ route('admin.login.store') }}" method="post">
                @csrf
                <div class="m-b-26 w-100">
                    <div class="wrap-input100 validate-input" data-validate="メールアドレスは必須です">
                        <span class="label-input100">メールアドレス</span>
                        <input class="input100" type="text" name="email" placeholder="" value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                    </div>
                    @include('admin.commons.components.html.errors', ['fieldName' => 'email'])
                </div>

                <div class="m-b-18 w-100">
                    <div class="wrap-input100 validate-input" data-validate="パスワードは必須です">
                        <span class="label-input100">パスワード</span>
                        <input type="password" class="d-none">
                        <input class="input100" type="password" name="password" placeholder="" autocomplete="new-password">
                        <span class="focus-input100"></span>
                    </div>
                    @include('admin.commons.components.html.errors', ['fieldName' => 'password'])
                </div>

                <div class="flex-sb-m w-full p-b-30">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="remember" type="checkbox" name="remember" value="1" @if(old('remember') === '1') checked @endif>
                        <label class="label-checkbox100" for="remember">
                            ログイン状態を保持する
                        </label>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">ログイン</button>
                    <div class="mx-auto mt-3">
                        <a href="#" class="txt1">パスワードをお忘れですか？</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/assets/plugins/animsition/js/animsition.min.js"></script>
<!-- <script src="/assets/plugins/select2/select2.min.js"></script> -->
<script src="/assets/plugins/countdowntime/countdowntime.js"></script>
<script src="/assets/admin/js/login.js?{{ now()->format('YmdHis') }}"></script>
@endpush
