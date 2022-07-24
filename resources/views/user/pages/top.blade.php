@extends('user.layouts.app')

@push('links')
<link href="/assets/user/css/top.css?{{ now()->format('YmdHis') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 pb-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative" data-dot="<img src='/assets/user/images/top-banner-1.png'>">
            <img class="img-fluid" src="/assets/user/images/top-banner-1.png" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">会員登録</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative" data-dot="<img src='/assets/user/images/top-banner-2.jpeg'>">
            <img class="img-fluid" src="/assets/user/images/top-banner-2.jpeg" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">ログイン</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative" data-dot="<img src='/assets/user/images/top-banner-3.png'>">
            <img class="img-fluid" src="/assets/user/images/top-banner-3.png" alt="">
            <div class="owl-carousel-inner">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-10 col-lg-8">
                            <h1 class="display-2 text-white animated slideInDown">Pioneers Of Solar And Renewable Energy</h1>
                            <p class="fs-5 fw-medium text-white mb-4 pb-3">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">会員登録</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<div class="container-fluid bg-light py-5">
    <div class="container px-1">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Information</h6>
            <h1 class="mb-4">お知らせ</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-md-12 col-lg-8 offset-lg-2">
                <div class="list-group">
                    @for ($i = 1; $i <= 3; $i++)
                    <a href="javascript:void(0)" class="list-group-item">
                        <div class="d-flex flex-wrap w-100">
                            <div class="d-flex w-100">
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <span class="me-3">2022.7.17</span>
                                    <span class="me-3 bg-primary text-white px-3 border-radius-5">お知らせ</span>
                                    <span class="flex-grow-1 d-block d-sm-inline-block mt-2 mt-sm-0">夏季休暇について</span>
                                </div>
                                <span class="my-auto"><i class="fas fa-chevron-right opacity-80"></i></span>
                            </div>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Tournament</h6>
            <h1 class="mb-4">大会情報</h1>
        </div>
        <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-12 text-center">
                <ul class="list-inline mb-5" id="isotope-flters">
                    <!-- <li class="mx-2 active" data-filter="*">すべて</li> -->
                    <li class="mx-2 active" data-filter=".2022-07-31">2022年7月31日</li>
                    <li class="mx-2" data-filter=".2022-08-28">2022年8月28日</li>
                    <li class="mx-2" data-filter=".2022-09-11">2022年9月11日</li>
                </ul>
            </div>
        </div>
        <div class="row g-4 isotope wow fadeInUp" data-wow-delay="0.5s">
            @for ($i = 1; $i <= 5; $i++)
            <div class="col-md-6 col-lg-4 isotope-item 2022-07-31">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="/assets/user/images/neyagawa.jpeg" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa-solid fa-person fa-3x"></i>
                        </div>
                        <h4 class="mb-3">2022年7月31日(日）9:00〜<br>初級男子シングルス</h4>
                        <p>場所：寝屋川公園　参加費：4,400円<br>募集人数：18人（残り5人）</p>
                        <a class="small fw-medium" href="">エントリーする<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            @endfor
            @for ($i = 1; $i <= 4; $i++)
            <div class="col-md-6 col-lg-4 isotope-item 2022-08-28">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="/assets/user/images/fukakita.jpeg" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa-solid fa-children fa-3x"></i>
                        </div>
                        <h4 class="mb-3">2022年8月28日(日）9:00〜<br>中級ミックスダブルス</h4>
                        <p>場所：深北緑地　参加費：5,000円<br>募集人数：20組（残り15組）</p>
                        <a class="small fw-medium" href="">エントリーする<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            @endfor
            @for ($i = 1; $i <= 6; $i++)
            <div class="col-md-6 col-lg-4 isotope-item 2022-09-11">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="/assets/user/images/chuburyokuchi.jpeg" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa-solid fa-user-group fa-3x"></i>
                        </div>
                        <h4 class="mb-3">2022年9月11日(日）10:00〜<br>初級女子ダブルス</h4>
                        <p>場所：中部緑地庭球場　参加費：5,000円<br>募集人数：18組（残り18組）</p>
                        <a class="small fw-medium" href="">エントリーする<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
<!-- Service End -->

<div class="container-fluid bg-light py-5 faq">
    <div class="container px-1">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">FAQs</h6>
            <h1 class="mb-4">よくあるご質問</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-md-12 col-lg-10 offset-lg-1">
                <div class="accordion accordion-flush px-xl-5" id="faqlist">
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                <i class="bi bi-question-circle question-icon"></i>
                                キャンセル代はいつ頃からかかりますか？
                            </button>
                        </h3>
                        <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                            <div class="accordion-body">
                                キャンセル代は試合当日3日前から発生します。前日まではダブルス3,300円・シングルス3,000円、当日キャンセルはダブルス5,000円・シングルス4,400円です。
                            </div>
                        </div>
                    </div><!-- # Faq item-->

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                <i class="bi bi-question-circle question-icon"></i>
                                1日の試合で最大何種目出場できますか？
                            </button>
                        </h3>
                        <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                            <div class="accordion-body">
                                1日最大2種目出場できます。3種目以上の出場はできません。
                            </div>
                        </div>
                    </div><!-- # Faq item-->

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                <i class="bi bi-question-circle question-icon"></i>
                                雨が降った場合はどうなりますか？
                            </button>
                        </h3>
                        <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                            <div class="accordion-body">
                                当日の朝7時までに試合の有無を登録していただいているLINE、もしくはメールアドレス宛てに連絡させていただきます。
                            </div>
                        </div>
                    </div><!-- # Faq item-->

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                                <i class="bi bi-question-circle question-icon"></i>
                                コロナで政府より緊急事態宣言がでた場合はどうなりますか？
                            </button>
                        </h3>
                        <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                            <div class="accordion-body">
                                <i class="bi bi-question-circle question-icon"></i>
                                当大会は市営コートを利用して運営しておりますので、緊急事態宣言により市営コートが使用できなくなった場合は大会を中止することがあります。
                            </div>
                        </div>
                    </div><!-- # Faq item-->

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                                <i class="bi bi-question-circle question-icon"></i>
                                会場の近くにコンビニはありますか？
                            </button>
                        </h3>
                        <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                            <div class="accordion-body">
                                会場によって近くにコンビニがないところもあります。また試合の進行状況によりコンビニに行く時間がないこともありますので、事前に買ってきていただくことをおすすめしております。
                            </div>
                        </div>
                    </div><!-- # Faq item-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function(){
    // isotopeの初期化。
    var isotope = $('.isotope').isotope({
        itemSelector: '.isotope-item', // 絞り込みを行う項目（子要素)を指定
        layoutMode: 'fitRows',
    });

    // 日付選択時に対象の大会に絞り込み
    $('#isotope-flters li').on('click', function () {
        $("#isotope-flters li").removeClass('active');
        $(this).addClass('active');
        // filterメソッドに絞り込みたい項目のセレクターを渡すだけ
        isotope.isotope({filter: $(this).data('filter')});
    });

    isotope.isotope({filter: $('#isotope-flters .active').data('filter')});
});
</script>
@endpush
