@extends('admin.layouts.base')

@section('body_class', 'login')

@section('inner_body')
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('admin.login.create') }}">
                    @csrf
                    <h1>ログイン画面</h1>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="bandail@gmail.com" required autofocus />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="*******" required autocomplete="current-password" />
                    </div>
                    <div>
                        <a class="btn btn-default submit pt-1" role="button">ログイン</a>
                        <a class="reset_pass" href="#">パスワードをお忘れですか？</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div><br/>
                        <div>
                            <h1>BB テニストーナメント</h1>
                            <p>Copyright © 2002 BBテニストーナメント.<br> All rights reserved.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
    $('.submit').click(function(){
        $('.login_form form').submit();
    });
});
</script>
@endpush
