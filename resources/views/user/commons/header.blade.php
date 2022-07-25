<!-- Topbar Start -->
<div class="container-fluid bg-dark p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small>〒573-0084 大阪府枚方市香里ケ丘3丁目9番36号</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <small class="far fa-clock text-primary me-2"></small>
                <small>18:30 〜 23:00（お電話でご連絡の場合）</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small class="me-3"><a class="text-grey" href="tel:0587-50-2005">0587-50-2005</a></small>
                <small class="fa-solid fa-mobile-screen text-primary me-2"></small>
                <small><a class="text-grey" href="tel:090-2357-6805">090-2357-6805</a></small>
            </div>
            {{-- このhtmlを消すとcontainer-fluidの高さが変わってしまうので、要素を見えなくして幅を0にする --}}
            <div class="h-100 d-inline-flex align-items-center mx-n2 invisible w-0">
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary w-0" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary w-0" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary w-0" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-square btn-link rounded-0 w-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0 text-primary">BBテニス</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <!-- active -->
            <a href="#information" class="nav-item nav-link">お知らせ</a>
            <a href="#tournament" class="nav-item nav-link">大会情報</a>
            <a href="#faq" class="nav-item nav-link">FAQ</a>
            <a href="#" class="nav-item nav-link">お問い合わせ</a>
            <a href="#" class="nav-item nav-link">ログイン</a>
            <a href="#" class="nav-item nav-link d-block d-lg-none">会員登録</a>
        </div>
        <a href="#" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">会員登録<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
