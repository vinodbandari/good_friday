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

        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Product Details</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start product details section -->
        <section class="product__details--section section--padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <div class="product__details--info">
                            <form action="#">


                                <p class="product__details--info__desc mb-15"></p>





                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End product details section -->


        {{-- PRODUCTS BY CATEGORY --}}
        <!-- Start product section -->

        @if ($products->count() > 0)
            @include('layouts.frontendincludes.gender_sortby')

            <div class="products-tab">
                @include('layouts.frontendincludes.productswrtcategory')
            </div>
        @else
            <div class="row">
                <div class="card-body text-center">
                    <h2><i class="fa fa-shopping-cart"></i>No Products are there</h2>
                    <br>
                    {{-- <a href="http://127.0.0.1:8000" class="btn btn-outline-primary float-end">Continue Shopping</a> --}}
                </div>
            </div>
        @endif
        <!-- End product section -->

        {{-- FEATURED PRODUCTS --}}
        <!-- Start product section -->
        <section class="product__section section--padding pt-0">
            <div class="container">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">FEATURED PRODUCT</h2>
                </div>
                @include('layouts.frontendincludes.swiper_trending_prod')
            </div>
        </section>
        <!-- End product section -->




    </main>


    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section -->

    @include('layouts.frontendincludes.quickwrapper')



    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
