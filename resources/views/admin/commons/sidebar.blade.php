<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.home.show') }}" class="site_title">
                <img class="logo" src="/assets/common/images/logo.png" alt="">
                <span>BB テニス</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/assets/common/images/no-person.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>ようこそ</span>
                <h2>{{ auth('admin')->user()->fullName() }}さん</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>メニュー</h3>
                <ul class="nav side-menu">
                    <li class="@if(request()->route()->named('admin.home.*')) active @endif">
                        <a href="{{ route('admin.home.show') }}"><i class="fa fa-home"></i>ホーム</a>
                    </li>
                    <li class="@if(request()->route()->named('admin.entry.*')) active @endif">
                        <a href="#"><i class="fas fa-file-signature"></i>エントリー管理</a>
                    </li>
                    <li class="@if(request()->route()->named('admin.tournament.*')) active @endif">
                        <a><i class="fa fa-trophy"></i>大会管理<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">一覧</a></li>
                            <li><a href="#">新規登録</a></li>
                        </ul>
                    </li>
                    <li class="@if(request()->route()->named('admin.contact.*')) active @endif">
                        <a href="#"><i class="fas fa-envelope"></i>問い合わせ管理</a>
                    </li>
                    <li class="@if(request()->route()->named('admin.notification.*')) active @endif">
                        <a href="#"><i class="fas fa-info-circle"></i>お知らせ管理</a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>マスタ</h3>
                <ul class="nav side-menu">
                    <li class="@if(request()->route()->named('admin.event.*')) active @endif">
                        <a href="{{ route('admin.event.input') }}"><i class="fas fa-racquet"></i>種目マスタ</a>
                    </li>
                    <li class="@if(request()->route()->named('admin.place.*')) active @endif">
                        <a href="#"><i class="fas fa-map-marker-alt"></i>場所マスタ</a>
                    </li>
                    <li class="@if(request()->route()->named('admin.organizer.*')) active @endif">
                        <a href="#"><i class="fas fa-user-clock"></i>運営者マスタ</a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>設定</h3>
                <ul class="nav side-menu">
                    <li class="@if(request()->route()->named('admin.admin.*')) active @endif">
                        <a><i class="fa-solid fa-user-gear"></i>管理者情報<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">一覧</a></li>
                            <li><a href="#">新規追加</a></li>
                        </ul>
                    </li>
                    <li class="@if(request()->route()->named('admin.password.*')) active @endif">
                        <a href="#"><i class="fa-solid fa-unlock-keyhole"></i>パスワード変更</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i>ログアウト</a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
