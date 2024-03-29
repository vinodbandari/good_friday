@include('layouts.laxmi.header')

<body>

    <!-- Start preloader -->
    {{-- @include('layouts.laxmi.preloader') --}}
    <!-- End preloader -->

    {{-- H E A D E R -------------------------------------------------------------------------------- --}}
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
        <div id="minicart">
            @include('layouts.laxmi.mini_cart')
        </div>
        <!-- End offCanvas minicart -->

        <!-- Start serch box area -->
        @include('layouts.laxmi.search_box')
        <!-- End serch box area -->

    </header>
    <!-- End header area ------------------------------------------------------------------------------------------->

    <main class="main__content_wrapper ">

        <!-- Start breadcrumb section ---------------------------------------------------------------------------------->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Shopping Cart</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -------------------------------------------------------------------------------->

        <!-- cart section start ------------------------------------------------------------------------------------->
        <section class="cart__section section--padding ">
            <div class="container-fluid cartitems">
                <div class="cart__section--inner ">
                    <form action="#">
                        <h2 class="cart__title mb-35">Shopping Cart</h2>
                        <div class="row">
                            @if ($cartitems->count() > 0)
                                <div class="col-lg-8  ">
                                    <div class="cart__table ">

                                        {{-- T A B L E   S T A R T ----------------------------------------------------------- --}}
                                        <table class="cart__table--inner">

                                            <thead class="cart__table--header">
                                                <tr class="cart__table--header__items">
                                                    <th class="cart__table--header__list">Product</th>
                                                    <th class="cart__table--header__list">Price</th>
                                                    <th class="cart__table--header__list">Quantity</th>
                                                    <th class="cart__table--header__list">Total</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $total = 0;
                                            @endphp
                                            <tbody class="cart__table--body">
                                                @foreach ($cartitems as $item)
                                                    <tr class="cart__table--body__items">
                                                        <td class="cart__table--body__list">
                                                            <div
                                                                class="cart__product d-flex align-items-center product_data">
                                                                <input type="hidden" class="prod_id"
                                                                    value="{{ $item->prod_id }}">

                                                                {{-- D E L E T E     P R O D U C T   F R O M   C A R T --}}
                                                                <div class="cartdelete">
                                                                    <button class="cart__remove--btn delete-cart-item"
                                                                        aria-label="search button" type="button">
                                                                        <svg fill="currentColor"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" width="16px"
                                                                            height="16px">
                                                                            <path
                                                                                d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                {{-- P R O D U C T    I M A G E --}}
                                                                <div class="cart__thumbnail">
                                                                    <a
                                                                        href="{{ url('category/' . $item->category->slug . '/' . $item->products->id) }}"><img
                                                                            style="height: 100px;width: 100px;"
                                                                            class="border-radius-5"
                                                                            src="{{ asset('assets/uploads/products/' . $item->products->image) }}"
                                                                            alt="cart-product"></a>
                                                                </div>

                                                                {{-- P R O D U C T   N A M E --}}
                                                                <div class="cart__content">
                                                                    <h3 class="cart__content--title h4"><a
                                                                            href="{{ url('category/' . $item->category->slug . '/' . $item->products->id) }}">{{ $item->products->name }}</a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- P R O D U C T    P R I C E --}}
                                                        <td class="cart__table--body__list">
                                                            <span
                                                                class="cart__price">Rs.{{ $item->products->selling_price }}</span>
                                                        </td>


                                                        {{-- I N C R E M E N T   A N D  D E C R E M E N T   O F   Q U A N T I T Y --}}
                                                        <td class="cart__table--body__list">
                                                            <div class="quantity__box product_data_qty_update">
                                                                <input type="hidden" class="prod_id_qty_update"
                                                                    value="{{ $item->prod_id }}">

                                                                <button type="button"
                                                                    class="quantity__value quickview__value--quantity changeQuantity decrease-btn"
                                                                    aria-label="quantity value"
                                                                    onclick="return false;">-</button>


                                                                <label>
                                                                    <input type="text" disabled
                                                                        class="quantity__number quickview__value--number qty-input"
                                                                        value="{{ $item->prod_qty }}" data-counter />

                                                                </label>
                                                                {{-- @if ($item->products->qty > $item->prod_qty) --}}
                                                                <button type="button"
                                                                    class="quantity__value quickview__value--quantity changeQuantity increase-btn"
                                                                    aria-label="quantity value"
                                                                    onclick="return false;">+</button>
                                                                {{-- @else
                                                                    <button type="button" disabled
                                                                        class="quantity__value quickview__value--quantity changeQuantity  increase-btn"
                                                                        aria-label="quantity value"
                                                                        onclick="return false;">+</button>
                                                                @endif --}}
                                                                <div id="new_price_update">
                                                                    @php $total += $item->products->selling_price * $item->prod_qty @endphp
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- T O T A L   P R I C E    O F    E A C H    P R O D U C T --}}

                                                        <td class="cart__table--body__list">
                                                            <span
                                                                class="cart__price end">Rs.{{ $item->products->selling_price * $item->prod_qty }}</span>
                                                        </td>


                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- E N D   O F   T A B L E ------------------------------------------------------- --}}


                                        {{-- C O N T I N U E  S H O P P I N G   A N D   C L E A R   T O T A L   C A R T   I T E M S  --}}
                                        <div class="continue__shopping d-flex justify-content-between">
                                            <a class="continue__shopping--link" href="{{ url('/') }}">Continue
                                                shopping</a>
                                            <a class="continue__shopping--clear" href="{{ url('/clearcart') }}"
                                                type="submit">Clear Cart</a>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-lg-4">
                                    <div class="cart__summary border-radius-10">

                                        {{-- C O U P O N --}}
                                        {{-- <div class="coupon__code mb-30">
                                        <h3 class="coupon__code--title">Coupon</h3>
                                        <p class="coupon__code--desc">Enter your coupon code if you have one.</p>
                                        <div class="coupon__code--field d-flex">
                                            <label>
                                                <input class="coupon__code--field__input border-radius-5" placeholder="Coupon code" type="text">
                                            </label>
                                            <button class="coupon__code--field__btn primary__btn" type="submit">Apply Coupon</button>
                                        </div>
                                    </div> --}}

                                        {{-- N O T E --}}
                                        {{-- <div class="cart__note mb-20">
                                        <h3 class="cart__note--title">Note</h3>
                                        <p class="cart__note--desc">Add special instructions for your seller...</p>
                                        <textarea class="cart__note--textarea border-radius-5"></textarea>
                                    </div> --}}

                                        {{-- T O T A L   A N D   S U B T O T A L   P R I C E --}}
                                        <div class="cart__summary--total mb-20">
                                            <table class="cart__summary--total__table">
                                                <tbody>
                                                    <tr class="cart__summary--total__list">
                                                        <td class="cart__summary--total__title text-left">SUBTOTAL</td>
                                                        <td class="cart__summary--amount text-right">
                                                            Rs.{{ $total }}</td>
                                                    </tr>
                                                    <tr class="cart__summary--total__list">
                                                        <td class="cart__summary--total__title text-left">GRAND TOTAL
                                                        </td>
                                                        <td class="cart__summary--amount text-right">
                                                            Rs.{{ $total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        {{-- C H E C K O U T --}}
                                        <div class="cart__summary--footer">
                                            <p class="cart__summary--footer__desc">Shipping & taxes calculated at
                                                checkout</p>
                                            <ul class="d-flex justify-content-between">
                                                <li><a
                                                    {{-- class="cart__summary--footer__btn primary__btn cart" --}}
                                                        {{-- href="/cart" --}}
                                                        type="submit">
                                                        {{-- Update Cart --}}
                                                    </a>
                                                </li>
                                                <li><a class="cart__summary--footer__btn primary__btn checkout"
                                                        href="{{ url('checkout') }}">Check Out</a></li>
                                            </ul>
                                        </div>


                                    </div>
                                </div>

                                {{-- I F    C A R T   I S   E M P T Y --}}
                            @else
                                <div class="card-body text-center">
                                    <h2>Your <i class="fa fa-shopping-cart"></i>Cart is empty</h2>
                                    <a href="{{ url('/') }}" class="btn btn-outline-primary float-end">Continue
                                        Shopping</a>
                                </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- cart section end -->



        {{-- FEATURED PRODUCTS ------------------------------------------------------------------------------------ --}}
        <!-- Start product section -->
        <section class="product__section section--padding pt-0" id="thekingtest">
            <div class="container ">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">FEATURED PRODUCT</h2>
                </div>
                @include('layouts.frontendincludes.swiper_trending_prod')
            </div>
        </section>
        <!-- End product section------------------------------------------------------------------------------------------ -->

        <!-- Start brand section ------------------------------------------------------------------------------------------->
        <div class="brand__section brand__section-two section--padding pt-0">
            <div class="container">
                @include('layouts.laxmi.brand_logos')
            </div>
        </div>
        <!-- End brand section ------------------------------------------------------------------------------------------------->

        <!-- Start feature section ---------------------------------------------------------------------------------------------->
        @include('layouts.laxmi.feature_icons')
        <!-- End feature section ----------------------------------------------------------------------------------------------->

    </main>



    {{-- F O O T E R----------------------------------------------------------------------------------------------------- --}}
    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section ------------------------------------------------------------------------------------------------>

    {{-- Q U I C K   W R A P P E R-------------------------------------------------------------------------------------- --}}
    <!-- Quickview Wrapper -->
    @include('layouts.frontendincludes.swipe_featured_quickwrap')
    <!-- Quickview Wrapper End ---------------------------------------------------------------------------------------------->


    {{-- S C R O L L   T O P    B A R ----------------------------------------------------------------------------------- --}}
    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    {{-- ------------------------------------------------------------------------------------------------------------------ --}}


    {{-- 3 --}}
