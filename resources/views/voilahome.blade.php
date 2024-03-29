@include('layouts.laxmi.header')

<body>


    <!-- Start preloader -->

    @include('layouts.laxmi.preloader')

    <!-- End preloader -->

    <!-- Start header area -->
    <header class="header__section">

        @include('layouts.laxmi.top_navbar')


        @include('layouts.laxmi.main_header')


        <!-- Start Offcanvas header menu -->
        @include('layouts.laxmi.offcanvas_header')
        <!-- End Offcanvas header menu -->

        <!-- Start Offcanvas sticky toolbar -->
        @include('layouts.laxmi.offcanvas_sticky')
        <!-- End Offcanvas sticky toolbar -->

        <!-- Start offCanvas minicart -->
        @include('layouts.laxmi.mini_cart')
        <!-- End offCanvas minicart -->

        <!-- Start serch box area -->
        @include('layouts.laxmi.search_box')
        <!-- End serch box area -->

    </header>
    <!-- End header area -->

    <main class="main__content_wrapper">
        <!-- Start slider section -->

        {{-- 3-Sliders --}}
        <section class="hero__slider--section">
            <div class="hero__slider--activation swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="home__three--slider__items">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-7 offset-lg-2">
                                        <div class="slider__content text-center">
                                            <h2 class="slider__maintitle text__primary h1">Jewellery to fit every
                                                budget, occasion, and taste</h2>
                                            <a class="primary__btn slider__btn" href="{{ url('shopping') }}">
                                                SHOP NOW
                                                <svg width="17" height="12" viewBox="0 0 17 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.9732 5.19375L11.1893 0.460018C11.1225 0.392216 11.0412 0.338185 10.9507 0.301395C10.8601 0.264605 10.7623 0.245867 10.6636 0.246372C10.5648 0.246877 10.4672 0.266615 10.377 0.304329C10.2869 0.342044 10.2061 0.396903 10.14 0.465385C10.001 0.610077 9.9245 0.79778 9.92549 0.992021C9.92649 1.18626 10.0049 1.37316 10.1454 1.51643L13.6531 4.9864L0.935903 5.05145C0.734471 5.06613 0.546408 5.15137 0.409525 5.29006C0.272641 5.42874 0.197086 5.61057 0.19805 5.799C0.199014 5.98743 0.276425 6.16848 0.41472 6.30575C0.553015 6.44303 0.74194 6.52635 0.943512 6.53896L13.6586 6.47392L10.1866 9.98155C10.0475 10.1262 9.97108 10.3139 9.97207 10.5082C9.97306 10.7024 10.0514 10.8893 10.192 11.0326C10.2588 11.1004 10.3401 11.1544 10.4306 11.1912C10.5212 11.228 10.6189 11.2467 10.7177 11.2462C10.8165 11.2457 10.9141 11.226 11.0042 11.1883C11.0944 11.1506 11.1751 11.0957 11.2413 11.0272L15.9786 6.25458C16.1206 6.1093 16.1989 5.91956 16.1979 5.72303C16.1969 5.5265 16.1167 5.33757 15.9732 5.19375Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hero__slider--layer style3">
                                <img class="slider__layer--img" src="{{ asset('uploads/slider1.webp') }}"
                                    alt="slider-img">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home__three--slider__items">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-7 offset-lg-2">
                                        <div class="slider__content text-center">
                                            <h2 class="slider__maintitle text__primary h1">Jewellery to fit every
                                                budget, occasion, and taste</h2>
                                            <a class="primary__btn slider__btn" href="{{ url('shopping') }}">
                                                SHOP NOW
                                                <svg width="17" height="12" viewBox="0 0 17 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.9732 5.19375L11.1893 0.460018C11.1225 0.392216 11.0412 0.338185 10.9507 0.301395C10.8601 0.264605 10.7623 0.245867 10.6636 0.246372C10.5648 0.246877 10.4672 0.266615 10.377 0.304329C10.2869 0.342044 10.2061 0.396903 10.14 0.465385C10.001 0.610077 9.9245 0.79778 9.92549 0.992021C9.92649 1.18626 10.0049 1.37316 10.1454 1.51643L13.6531 4.9864L0.935903 5.05145C0.734471 5.06613 0.546408 5.15137 0.409525 5.29006C0.272641 5.42874 0.197086 5.61057 0.19805 5.799C0.199014 5.98743 0.276425 6.16848 0.41472 6.30575C0.553015 6.44303 0.74194 6.52635 0.943512 6.53896L13.6586 6.47392L10.1866 9.98155C10.0475 10.1262 9.97108 10.3139 9.97207 10.5082C9.97306 10.7024 10.0514 10.8893 10.192 11.0326C10.2588 11.1004 10.3401 11.1544 10.4306 11.1912C10.5212 11.228 10.6189 11.2467 10.7177 11.2462C10.8165 11.2457 10.9141 11.226 11.0042 11.1883C11.0944 11.1506 11.1751 11.0957 11.2413 11.0272L15.9786 6.25458C16.1206 6.1093 16.1989 5.91956 16.1979 5.72303C16.1969 5.5265 16.1167 5.33757 15.9732 5.19375Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hero__slider--layer style3">
                                <img class="slider__layer--img" src="{{ asset('uploads/slider2.webp') }}"
                                    alt="slider-img">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home__three--slider__items">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-7 offset-lg-2">
                                        <div class="slider__content text-center">
                                            <h2 class="slider__maintitle text__primary h1">Jewellery to fit every
                                                budget, occasion, and taste</h2>
                                            <a class="primary__btn slider__btn" href="{{ url('shopping') }}">
                                                SHOP NOW
                                                <svg width="17" height="12" viewBox="0 0 17 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.9732 5.19375L11.1893 0.460018C11.1225 0.392216 11.0412 0.338185 10.9507 0.301395C10.8601 0.264605 10.7623 0.245867 10.6636 0.246372C10.5648 0.246877 10.4672 0.266615 10.377 0.304329C10.2869 0.342044 10.2061 0.396903 10.14 0.465385C10.001 0.610077 9.9245 0.79778 9.92549 0.992021C9.92649 1.18626 10.0049 1.37316 10.1454 1.51643L13.6531 4.9864L0.935903 5.05145C0.734471 5.06613 0.546408 5.15137 0.409525 5.29006C0.272641 5.42874 0.197086 5.61057 0.19805 5.799C0.199014 5.98743 0.276425 6.16848 0.41472 6.30575C0.553015 6.44303 0.74194 6.52635 0.943512 6.53896L13.6586 6.47392L10.1866 9.98155C10.0475 10.1262 9.97108 10.3139 9.97207 10.5082C9.97306 10.7024 10.0514 10.8893 10.192 11.0326C10.2588 11.1004 10.3401 11.1544 10.4306 11.1912C10.5212 11.228 10.6189 11.2467 10.7177 11.2462C10.8165 11.2457 10.9141 11.226 11.0042 11.1883C11.0944 11.1506 11.1751 11.0957 11.2413 11.0272L15.9786 6.25458C16.1206 6.1093 16.1989 5.91956 16.1979 5.72303C16.1969 5.5265 16.1167 5.33757 15.9732 5.19375Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hero__slider--layer style3">
                                <img class="slider__layer--img" src="{{ asset('uploads/slider3.webp') }}"
                                    alt="slider-img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider__pagination swiper-pagination"></div>
            </div>
        </section>
        <!-- End slider section -->

        <!-- Start collection section -->

        {{-- Shop by category --}}
        @include('layouts.frontendincludes.shopbycategory')
        <!-- End collection section -->

        <!-- Start grid banner section -->
        <section class="grid__banner--section section--padding pt-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="grid__banner--thumbnail">
                            <img src="{{ asset('uploads/brightenup.webp') }}" alt="banner-img">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="grid__banner--content margin__left">
                            <h2 class="grid__banner--title">Curated By Color</h2>
                            <p class="grid__banner--desc">Brighten up your look with vibrant gemstone Jewellery.</p>
                            {{-- <a class="grid__banner--btn primary__btn" href="{{ url('shopping') }}">SHOP NOW</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End grid banner section -->

        <!-- Start grid banner section -->
        <section class="grid__banner--section">
            <div class="container">
                <div class="row row_sm_u_reverse align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="grid__banner--content margin__left">
                            <h2 class="grid__banner--title">Soak Up The Savings</h2>
                            <p class="grid__banner--desc">Brighten up your look with vibrant gemstone Jewellery.</p>
                            {{-- <a class="grid__banner--btn primary__btn" href="{{ url('shopping') }}">SHOP NOW</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="grid__banner--thumbnail">
                            <img src="{{ asset('uploads/soakup.webp') }}" alt="banner-img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End grid banner section -->


        {{-- TRENDING PRODUCTS --}}
        <!-- Start product section -->
        <section class="product__section section--padding ">
            <div class="container">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">TRENDING PRODUCT</h2>
                </div>
                @include('layouts.frontendincludes.trending_products')
            </div>
        </section>
        <!-- End product section -->







        <!-- Start banner section -->
        <section class="banner__section section--padding pt-0">
            <div class="container-fluid p-0">
                <div class="row no-gutter mb--n30">
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                        <div class="banner__box border-radius-5 position-relative">
                            {{-- <a class="display-block"
                             href="{{ url('shopping') }}"
                             > --}}
                             <img
                                    class="banner__box--thumbnail border-radius-5"
                                    src="{{ asset('uploads/storebeautilx.webp') }}" alt="banner-img">
                                <div class="fullwidth__banner--box__content left">
                                    <p class="fullwidth__banner--box__subtitle">Store Beautlux</p>
                                    <h2 class="fullwidth__banner--box__title ">Jewellery <br>
                                        Online</h2>
                                    {{-- <span class="banner__box--content__btn primary__btn">SHOP NOW </span> --}}
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                        <div class="banner__box border-radius-5 position-relative">
                            {{-- <a class="display-block" href="{{ url('shopping') }}"> --}}
                                <img
                                    class="banner__box--thumbnail border-radius-5"
                                    src="{{ asset('uploads/storebeautilx2.webp') }}" alt="banner-img">
                                <div class="fullwidth__banner--box__content right">
                                    <p class="fullwidth__banner--box__subtitle">Store Beautlux</p>
                                    <h2 class="fullwidth__banner--box__title ">Rings <br>
                                        Collections</h2>
                                    {{-- <span class="banner__box--content__btn primary__btn">SHOP NOW </span> --}}
                                </div>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End banner section -->


        {{-- SMALL FEATURED AND ONSALE PRODUCTS --}}
        <!-- Start small product section -->
        <section class="small__product--section section--padding pt-0">
            <div class="container">
                <div class="row mb--n30">



                    {{-- S M A L L   F E A T U R E D   P R O D U C T S  1 --}}
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="small__product--step">
                            <div class="section__heading mb-30">
                                <h2 class="section__heading--maintitle">Featured Products</h2>
                            </div>
                            <div class="small__product--step__inner">
                                @foreach ($mini_featured1 as $mini_prod)
                                    <article class="small__product--card d-flex align-items-center">
                                        <div class="small__product--thumbnail">
                                            <a class="display-block" href="/category/{{ $mini_prod->category->slug }}/{{ $mini_prod->id }}"><img
                                                    class="small__product--thumbnail__img"
                                                    style="height: 120px;width: 134px;"
                                                    src="{{ asset('assets/uploads/products/' . $mini_prod->image) }}"
                                                    alt="img">
                                            </a>


                                            @php
                                            $perc = ($mini_prod->original_price - $mini_prod->selling_price)/$mini_prod->original_price
                                            @endphp

                                            @php
                                            $discount = ($mini_prod->selling_price < $mini_prod->original_price)
                                            @endphp






                                        </div>
                                        <div class="small__product--content">
                                            <h3 class="product__card--title"><a
                                                    href="/category/{{ $mini_prod->category->slug }}/{{ $mini_prod->id }}">{{ $mini_prod->name }}
                                                </a>
                                            </h3>







                                            <div class="product__card--price">
                                                <span class="current__price">Rs.{{ $mini_prod->selling_price ?? ''}}</span>

                                                @if($discount)
                                                <span class="old__price">Rs.{{ $mini_prod->original_price ?? '' }}</span>
                                                @endif

                                                @if($discount)
                                                <span class="btn btn-danger">{{ round($perc*100) }}% off</span>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    {{-- O N S A L E   S M A L L  P R O D U C T S --}}
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="small__product--step">
                            <div class="section__heading mb-30">
                                <h2 class="section__heading--maintitle">Onsale Products</h2>
                            </div>
                            <div class="small__product--step__inner">
                                @foreach ($onsale_products as $onsale)
                                    <article class="small__product--card d-flex align-items-center">
                                        <div class="small__product--thumbnail">
                                            <a class="display-block" href="/category/{{ $onsale->category->slug }}/{{ $onsale->id }}"><img
                                                    style="height: 120px;width: 134px;"
                                                    class="small__product--thumbnail__img" height="120px"
                                                    width="120px"
                                                    src="{{ asset('assets/uploads/products/' . $onsale->image) }}"
                                                    alt="img">
                                            </a>

                                            @php
                                            $perc = ($onsale->original_price - $onsale->selling_price)/$onsale->original_price
                                            @endphp

                                            @php
                                            $discount = ($onsale->selling_price < $onsale->original_price)
                                            @endphp


                                        </div>
                                        <div class="small__product--content">
                                            <h3 class="product__card--title"><a
                                                    href="/category/{{ $onsale->category->slug }}/{{ $onsale->id }}">{{ $onsale->name }}</a>
                                            </h3>

                                            <div class="product__card--price">
                                                <span class="current__price">Rs.{{ $onsale->selling_price }}</span>

                                                @if($discount)
                                                <span class="old__price">Rs.{{ $onsale->original_price }}</span>
                                                @endif

                                                @if($discount)
                                                <span class="btn btn-danger">{{ round($perc*100) }}% off</span>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    {{-- S M A L L   F E A T U R E D   P R O D U C T S  2 --}}
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="small__product--step">
                            <div class="section__heading mb-30">
                                <h2 class="section__heading--maintitle">Featured Products</h2>
                            </div>
                            <div class="small__product--step__inner">
                                @foreach ($mini_featured2 as $prods)
                                    <article class="small__product--card d-flex align-items-center">
                                        <div class="small__product--thumbnail">
                                            <a class="display-block" href="/category/{{ $prods->category->slug }}/{{ $prods->id }}"><img
                                                    style="height: 120px;width: 134px;"
                                                    class="small__product--thumbnail__img" height="120px"
                                                    width="120px"
                                                    src="{{ asset('assets/uploads/products/' . $prods->image) }}"
                                                    alt="img">
                                            </a>


                                            @php
                                            $perc = ($prods->original_price - $prods->selling_price)/$prods->original_price
                                            @endphp

                                            @php
                                            $discount = ($prods->selling_price < $prods->original_price)
                                            @endphp

                                        </div>
                                        <div class="small__product--content">
                                            <h3 class="product__card--title"><a
                                                    href="/category/{{ $prods->category->slug }}/{{ $prods->id }}">{{ $prods->name }}</a>
                                            </h3>



                                            {{-- P R I C E   F O R   S M A L L   F E A T U R E D  P R O D U C T S --}}
                                            <div class="product__card--price">
                                                <span class="current__price">Rs.{{ $prods->selling_price }}</span>

                                                @if($discount)
                                                <span class="old__price">Rs.{{ $prods->original_price }}</span>
                                                @endif

                                                @if($discount)
                                                <span class="btn btn-danger">{{ round($perc*100) }}% off</span>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- End small product section -->

        <!-- Start banner advice section -->
        {{-- <section class="advice__banner--section section--padding pt-0">
            <div class="advice__banner--box position-relative">
                <img class="advice__banner--thumbnail height_260 border-radius-5" src="{{ asset('uploads/flat50.webp') }}" alt="banner">
                <div class="advice__banner--content style2">
                    <h2 class="advice__banner--title">Flat 50% Off On Fresh Jewellery</h2>
                    <p class="advice__banner--desc mb-30">50% OFF on the most popular cosmetic brands. Order all classy products today!
                    </p>
                    <a class="advice__banner--btn primary__btn" href="{{ url('shopping') }}">SHOP NOW</a>
                </div>
            </div>
        </section> --}}
        <!-- End banner advice section -->

        {{-- BLOG --}}
        <!-- Start blog section -->
        {{-- @include('layouts.frontendincludes.blog_section') --}}
        <!-- End blog section -->

        {{-- CLIENT REVIEWS --}}
        <!-- Start testimonial section -->
        {{-- @include('layouts.frontendincludes.clientreviews') --}}
        <!-- End testimonial section -->

        {{-- SUBSCRIBE --}}
        <!-- Start newsletter section -->
        {{-- @include('layouts.frontendincludes.news_letter') --}}
        <!-- End newsletter section -->

    </main>

    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section -->

    <!-- Quickview Wrapper -->
    @include('layouts.frontendincludes.quickwrapper')
    <!-- Quickview Wrapper End -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
