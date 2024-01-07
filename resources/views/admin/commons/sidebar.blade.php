<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">BBテニス</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="@if (request()->route()->named('admin.home.*')) mm-active @endif">
            <a href="{{ route('admin.home.index') }}">
                <div class="parent-icon">
                    <i class='bx bx-home'></i>
                </div>
                <div class="menu-title">ホーム</div>
            </a>
        </li>

        <li class="menu-label">メニュー</li>
        <li class="@if (request()->route()->named('admin.entry.*')) mm-active @endif">
            <a href="#">
                <div class="parent-icon">
                    <i class='bx bx-file'></i>
                </div>
                <div class="menu-title">エントリー管理</div>
            </a>
        </li>

        <li class="@if (request()->route()->named('admin.tournament.*')) mm-active @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-trophy'></i>
                </div>
                <div class="menu-title">大会管理</div>
            </a>
            <ul class="@if (request()->route()->named('admin.tournament.*')) mm-show @endif">
                <li class="@if (request()->route()->named('admin.tournament.list')) mm-active @endif">
                    <a href="{{ route('admin.tournament.list') }}"><i class="bx bx-right-arrow-alt"></i>一覧</a>
                </li>
                <li class="@if (request()->route()->named('admin.tournament.add')) mm-active @endif">
                    <a href="{{ route('admin.tournament.add') }}"><i class="bx bx-right-arrow-alt"></i>新規登録</a>
                </li>
            </ul>
        </li>

        <li class="@if (request()->route()->named('admin.contact.*')) mm-active @endif">
            <a href="#">
                <div class="parent-icon">
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="menu-title">お問い合わせ管理</div>
            </a>
        </li>

        <li class="@if (request()->route()->named('admin.information.*')) mm-active @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-info-circle'></i>
                </div>
                <div class="menu-title">お知らせ管理</div>
            </a>
            <ul class="@if (request()->route()->named('admin.information.*')) mm-show @endif">
                <li class="@if (request()->route()->named('admin.information.list')) mm-active @endif">
                    <a href="{{ route('admin.information.list') }}"><i class="bx bx-right-arrow-alt"></i>一覧</a>
                </li>
                <li class="@if (request()->route()->named('admin.information.add')) mm-active @endif">
                    <a href="{{ route('admin.information.add') }}"><i class="bx bx-right-arrow-alt"></i>新規登録</a>
                </li>
            </ul>
        </li>

        <li class="@if (request()->route()->named('admin.faq.*')) mm-active @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-help-circle'></i>
                </div>
                <div class="menu-title">FAQ管理</div>
            </a>
            <ul class="@if (request()->route()->named('admin.faq.*')) mm-show @endif">
                <li class="@if (request()->route()->named('admin.faq.list')) mm-active @endif">
                    <a href="{{ route('admin.faq.list') }}"><i class="bx bx-right-arrow-alt"></i>一覧</a>
                </li>
                <li class="@if (request()->route()->named('admin.faq.add')) mm-active @endif">
                    <a href="{{ route('admin.faq.add') }}"><i class="bx bx-right-arrow-alt"></i>新規登録</a>
                </li>
            </ul>
        </li>

        <li class="menu-label">マスター</li>

        <li class="@if (request()->route()->named('admin.event.*')) mm-active @endif">
            <a href="{{ route('admin.event.list') }}">
                <div class="parent-icon">
                    <i class='bx bx-category-alt'></i>
                </div>
                <div class="menu-title">種目マスター</div>
            </a>
        </li>

        <li class="@if (request()->route()->named('admin.place.*')) mm-active @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-map-pin"></i>
                </div>
                <div class="menu-title">場所マスター</div>
            </a>
            <ul class="@if (request()->route()->named('admin.place.*')) mm-show @endif">
                <li class="@if (request()->route()->named('admin.place.list')) mm-active @endif">
                    <a href="{{ route('admin.place.list') }}"><i class="bx bx-right-arrow-alt"></i>一覧</a>
                </li>
                <li class="@if (request()->route()->named('admin.place.add')) mm-active @endif">
                    <a href="{{ route('admin.place.add') }}"><i class="bx bx-right-arrow-alt"></i>新規登録</a>
                </li>
            </ul>
        </li>

        <li class="menu-label">設定</li>

        <li class="@if (request()->route()->named('admin.admin.*')) mm-active @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class='bx bx-user-check'></i>
                </div>
                <div class="menu-title">管理者管理</div>
            </a>
            <ul class="@if (request()->route()->named('admin.admin.*')) mm-show @endif">
                <li class="@if (request()->route()->named('admin.admin.list')) mm-active @endif">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i>一覧</a>
                </li>
                <li class="@if (request()->route()->named('admin.admin.add')) mm-active @endif">
                    <a href="#"><i class="bx bx-right-arrow-alt"></i>新規登録</a>
                </li>
            </ul>
        </li>

        <li class="@if (request()->route()->named('admin.setting.*')) mm-active @endif">
            <a href="#">
                <div class="parent-icon">
                    <i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">設定</div>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.logout') }}">
                <div class="parent-icon">
                    <i class="bx bx-power-off"></i>
                </div>
                <div class="menu-title">ログアウト</div>
            </a>
        </li>

        <li class="menu-label">開発者ツール</li>
        <li>
            <a href="{{ route('admin.adminer.auto_login') }}" target="_blank">
                <div class="parent-icon">
                    <i class='bx bx-data'></i>
                </div>
                <div class="menu-title">データベース</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>