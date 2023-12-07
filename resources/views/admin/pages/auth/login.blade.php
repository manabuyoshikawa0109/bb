@extends('admin.layouts.base')

@push('links')
<style>
.authentication-header {
    background: #16181f !important;
}
/*
スマホ時画面上側に空白ができてしまうので、その調整
*/
.wrapper {
    position: static !important;
}
</style>
@endpush

@section('inner-body')
<!--wrapper-->
<div class="wrapper">
    <div class="authentication-header"></div>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="/assets/admin/images/logo-img.png" width="180" alt="" />
                    </div>
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="p-sm-4 py-4 rounded">
                                <div class="text-center">
                                    <h3 class="">ログイン</h3>
                                </div>
                                <div class="d-grid">
                                    <a class="btn my-4 shadow-sm btn-white" href="javascript:;">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="/assets/admin/images/icons/search.svg" width="16" alt="Image Description">
                                            <span>Googleアカウントでログイン</span>
                                        </span>
                                    </a>
                                    <a href="javascript:;" class="btn btn-facebook">
                                        <i class="bx bxl-facebook"></i>Facebookアカウントでログイン
                                    </a>
                                </div>
                                <div class="login-separater text-center mb-4">
                                    <span>メールアドレスでログイン</span>
                                    <hr/>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route('admin.login.store') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">メールアドレス</label>
                                            @include('admin.commons.components.html.email', ['id' => 'inputEmailAddress', 'fieldName' => "email"])
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">パスワード</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            @include('admin.commons.components.html.errors', ['fieldName' => 'password'])
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="remember" value="1" @if(old('remember') === '1') checked @endif>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">ログイン状態を<br>保持する</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="#">パスワードを忘れた場合</a>
                                        </div>
                                        @include('admin.commons.components.html.errors', ['fieldName' => 'remember'])
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-dark"><i class="bx bxs-lock-open"></i>ログイン</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
</script>
@endpush
