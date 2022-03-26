<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">
                <img class="logo" src="/assets/common/images/logo.jpg" alt="">
                <!-- <i class="fa fa-paw"></i> -->
                <span>Bandail</span>
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
                <h2>{{ auth('user')->user()->fullName() }}さん</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>メニュー</h3>
                <ul class="nav side-menu">
                    <li class="@if(request()->route()->named('user.home.*')) active @endif">
                        <a href="{{ route('user.home.show') }}"><i class="fa fa-home"></i>ホーム</a>
                    </li>
                    <li>
                        <a><i class="fa fa-trophy"></i>試合エントリー<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">BBテニス</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa-solid fa-user-gear"></i>ユーザー情報<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">ユーザー情報詳細</a></li>
                            <li><a href="#">ユーザー情報編集</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>その他</h3>
                <ul class="nav side-menu">
                    <li><a href="#"><i class="fa-solid fa-unlock-keyhole"></i>パスワード変更</a></li>
                    <li><a href="{{ route('user.logout') }}"><i class="fa fa-sign-out"></i>ログアウト</a></li>
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
