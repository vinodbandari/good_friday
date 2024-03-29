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
                        <div class="product__details--media">
                            <div class="single__product--preview bg__gray  swiper mb-18">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product__media--preview__items">
                                            <a class="product__media--preview__items--link "
                                                data-gallery="product-media-preview"><img
                                                    class="product__media--preview__items--img"
                                                    src="{{ asset('assets/uploads/products/' . $products->image) }}"
                                                    alt="product-media-img" style="height: ;width: ;"></a>


                                            @php
                                                $perc = ($products->original_price - $products->selling_price) / $products->original_price;
                                            @endphp

                                            @php
                                                $discount = $products->selling_price < $products->original_price;
                                            @endphp

                                            @if ($discount)
                                                <span class="product__badge">{{ round($perc * 100) }}% off</span>
                                            @endif
                                            {{-- <div class="product__media--view__icon">

                                            </div> --}}


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single__product--nav swiper" style="display: none">

                            </div>
                        </div>
                    </div>

                    {{-- PRODUCT NAME,SELLING PRICE ETC......... --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details--info product_data">
                            <form action="#">

                                {{-- P R O D U C T   N A M E , P R I C E --}}
                                <h2 class="product__details--info__title mb-15">{{ $products->name }} </h2>


                                <div class="product__details--info__price mb-12">
                                    <span class="current__price">Rs.{{ $products->selling_price }}</span>
                                    <span class="old__price">Rs.{{ $products->original_price }}</span>
                                </div>


                                <br>

                                {{-- P R O D U C T    D E S C R I P T I O N --}}
                                {{-- <p class="product__details--info__desc mb-15">{{ $products->small_description }}</p> --}}





                                <div class="product__variant--list quantity  d-flex align-items-center mb-20">

                                    {{-- Q U A N T I T Y   I N C R E M E N T   A N D    D E C R E M E N T --}}
                                    <div class="quantity__box minicart__quantity product_data_qty_update">
                                        <input id='product_id' type="hidden" value="{{ $products->id }}"
                                            class="prod_id_qty_update">
                                        <button type="button" class="quantity__value decrease-btn"
                                            aria-label="quantity value">-</button>
                                        <label>
                                            <input type="text" class="quantity__number qty-input" value="1"
                                                data-counter />
                                        </label>
                                        <button type="button" class="quantity__value increase-btn"
                                            aria-label="quantity value">+</button>

                                    </div>
                                    <br>

                                    {{-- A D D   T O   C A R T    I F   S T O C K   I S   A V A I L A B L E --}}
                                    @if ($products->qty > 0)
                                        <label class="badge bg-success product_data">In stock</label>
                                        <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                        <input type="hidden" value="{{ $products->cate_id }}" class="cate_id">
                                        <button class="primary__btn quickview__cart--btn addToCartBtn"
                                            type="submit">{{ $cartitems->contains('prod_id', $products->id) ? 'Already In Cart' : '+Add to cart' }}</button>
                                        <button class="primary__btn quickview__cart--btn buynow">Buynow</button>
                                    @else
                                        <label class="badge bg-danger">Out of stock</label>
                                    @endif

                                </div>

                                {{-- A D D  T O   W I S H L I S T --}}
                                <div class="product__variant--list mb-20 addToWishlist">
                                    <a class="variant__wishlist--icon mb-15 " title="Add to wishlist">
                                        <svg class="quickview__variant--wishlist__svg "
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                        </svg>
                                        Add to Wishlist
                                    </a>
                                </div>

                        </div>

                        {{-- S O C I A L   S H A R E --}}
                        {{-- <div class="quickview__social d-flex align-items-center mb-20">
                            <label class="quickview__social--title">Social Share:</label>
                            <ul class="quickview__social--wrapper mt-0 d-flex">
                                <li class="quickview__social--list">
                                    <a class="quickview__social--icon" target="_blank" href="https://www.facebook.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                            viewBox="0 0 7.667 16.524">
                                            <path data-name="Path 237"
                                                d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                                transform="translate(-960.13 -345.407)" fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li class="quickview__social--list">
                                    <a class="quickview__social--icon" target="_blank" href="https://twitter.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384"
                                            viewBox="0 0 16.489 13.384">
                                            <path data-name="Path 303"
                                                d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z"
                                                transform="translate(-951.23 -1140.849)" fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Twitter</span>
                                    </a>
                                </li>
                                <li class="quickview__social--list">
                                    <a class="quickview__social--icon" target="_blank"
                                        href="https://www.instagram.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492"
                                            viewBox="0 0 19.497 19.492">
                                            <path data-name="Icon awesome-instagram"
                                                d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z"
                                                transform="translate(0.004 -1.492)" fill="currentColor">
                                            </path>
                                        </svg>
                                        <span class="visually-hidden">Instagram</span>
                                    </a>
                                </li>
                                <li class="quickview__social--list">
                                    <a class="quickview__social--icon" target="_blank"
                                        href="https://www.youtube.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582"
                                            viewBox="0 0 16.49 11.582">
                                            <path data-name="Path 321"
                                                d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z"
                                                transform="translate(-951.269 -1359.8)" fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Youtube</span>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}

                        {{-- G U A R A N T E E D     S A F E    C H E C K O U T --}}
                        <div class="guarantee__safe--checkout mb-30">
                            <h5 class="guarantee__safe--checkout__title">Guaranteed Safe Checkout</h5>
                            <img class="guarantee__safe--checkout__img"
                                src="{{ asset('uploads/safe-checkout.webp') }}" alt="Payment Image">
                        </div>


                        <fieldset class="variant__input--fieldset">
                            @if ($products->stone_name)
                                <legend class="product__variant--title mb-8">Stone :
                                    {{ $products->stone_name }}
                                </legend>
                            @else
                                <legend class="product__variant--title">Stone :
                                    Not Available
                                </legend>
                            @endif
                        </fieldset>

                        <fieldset class="variant__input--fieldset">
                            @if ($products->weight)
                                <legend class="product__variant--title mb-8">Stone :
                                    {{ $products->weight }}
                                </legend>
                            @else
                                <legend class="product__variant--title">Weight :
                                    Not Available
                                </legend>
                            @endif
                        </fieldset>


                        {{-- D E S C R I P T I O N --}}
                        <div class="product__details--accordion">
                            <div class="product__details--accordion__list">
                                <details>
                                    <summary class="product__details--summary">
                                        <h2 class="product__details--summary__title">Description
                                            <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg"
                                                class="order-summary-toggle__dropdown" fill="currentColor">
                                                <path
                                                    d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z">
                                                </path>
                                            </svg>
                                        </h2>
                                    </summary>





                                    <div class="product__details--summary__wrapper">
                                        <div class="product__tab--content">
                                            <div class="product__tab--content__step mb-30">
                                                <h2 class="product__tab--content__title h4 mb-10">
                                                    {{ $products->small_description }}
                                                </h2>
                                                <p class="product__tab--content__desc">
                                                    {{ $products->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </details>
                            </div>
                        </div>



                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End product details section -->

        {{-- Y O U   M A Y   A L S O  L I K E       F E A T U R E D   P R O D U C T S ------------------------------------------- --}}
        <!-- Start product section -->
        <section class="product__section section--padding pt-0">
            <div class="container">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">You May Also Like</h2>
                </div>
                @include('layouts.frontendincludes.swiper_trending_prod')
            </div>
        </section>
        <!-- End product section -->


        {{-- B R A N D   S E C T I O N ---------------------------------------------------------------------------------------- --}}
        <!-- Start brand section -->
        <div class="brand__section brand__section-two section--padding pt-0">
            <div class="container">
                @include('layouts.laxmi.brand_logos')
            </div>
        </div>
        <!-- End brand section -->

        {{-- F E A T U R E    I C O N S --------------------------------------------------------------------------------------- --}}
        <!-- Start feature section -->
        @include('layouts.laxmi.feature_icons')
        <!-- End feature section -->
    </main>

    {{-- F O O T E R ---------------------------------------------------------------------------------------------------------- --}}
    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section -->


    {{-- Q U I C K   W R A P P E R ------------------------------------------------------------------------------------------- --}}
    <!-- Quickview Wrapper -->
    @include('layouts.frontendincludes.swipe_featured_quickwrap')
    <!-- Quickview Wrapper End -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
