
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
        @include(('layouts.laxmi.search_box'))
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
                                <li class="breadcrumb__content--menu__items"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Wishlist</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- cart section start -->
        <section class="cart__section section--padding">
            <div class="container wishlistitems">
                <div class="cart__section--inner">
                    <form action="#">
                        <h2 class="cart__title mb-30">Wishlist</h2>
                        <div class="cart__table ">
                            @if($wishlist->count() > 0)
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list text-center">STOCK STATUS</th>
                                        <th class="cart__table--header__list text-right">ADD TO CART</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">

                                        @foreach($wishlist as $item)
                                            <tr class="cart__table--body__items product_data">
                                                <td class="cart__table--body__list">
                                                    <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                                                    <input type="hidden" value="{{ $item->cate_id }}" class="cate_id">
                                                    <div class="cart__product d-flex align-items-center">

                                                        {{-- R E M O V E   E A C H   I T E M  I N   W I S H L I S T --}}
                                                        <button class="cart__remove--btn remove-wishlist-item" aria-label="search button" type="button">
                                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                                        </button>

                                                        {{-- P R O D U C T   I M A G E --}}
                                                        <div class="cart__thumbnail">
                                                            <a href="{{ url('category/'.$item->category->slug.'/'.$item->products->id) }}">
                                                                <img class="border-radius-5" src="{{asset('assets/uploads/products/'.$item->products->image)}}" alt="cart-product">
                                                            </a>
                                                        </div>

                                                        {{-- N A M E    O F   T H E   P R O D U C T --}}
                                                        <div class="cart__content">
                                                            <h3 class="cart__content--title h4"><a href="product-details.html">{{ $item->products->name }}</a></h3>
                                                        </div>

                                                    </div>
                                                </td>

                                                {{-- P R I C E   O F   T H E   P R O D U C T --}}
                                                <td class="cart__table--body__list">
                                                    <span class="cart__price">Rs.{{ $item->products->selling_price }}</span>
                                                </td>


                                                {{-- A V A B I L I T Y   O F    S T O C K --}}
                                                <td class="cart__table--body__list text-center">
                                                 <input type="hidden" class="quantity__number qty-input"  value="1" data-counter />
                                                    @if($item->products->qty <= 10 && $item->products->qty > 0)
                                                    <span class="in__stock text__secondary">Only {{ $item->products->qty }} are left</span>
                                                    @elseif($item->products->qty > 0)
                                                    <span class="in__stock text__secondary">in stock</span>
                                                    @else
                                                    <span class="in__stock text__secondary">out of stock</span>
                                                    @endif
                                                </td>


                                                {{-- A D D   T O    C A R T --}}
                                         @if($item->products->qty > 0)
                                                <td class="cart__table--body__list text-right">
                                                    <a class="wishlist__cart--btn primary__btn addToCartBtn" >{{ ($cartitems->contains('prod_id',$item->products->id)) ? "Already In Cart" : "+Add to cart"}}</a>
                                                </td>


                                         @endif

                                            </tr>
                                         @endforeach

                                </tbody>
                            </table>

                            {{-- I F    W I S H L I S T   I S   E M P T Y --}}
                            @else
                                     <h4>There are no products in your Wishlist</h4>
                            @endif

                            {{-- C O N T I N U E   S H O P P I N G --}}
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="{{ url('/') }}">Continue shopping</a>
                                <a class="continue__shopping--clear" href="{{ url('/shopping') }}">View All Products</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- cart section end -->


        {{-- FEATURED PRODUCTS ----------------------------------------------------}}
        <!-- Start product section -->
        <section class="product__section section--padding pt-0">
            <div class="container">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">FEATURED PRODUCT</h2>
                </div>
               @include('layouts.frontendincludes.swiper_trending_prod')
            </div>
        </section>
        <!-- End product section -------------------------------------------------->

        <!-- Start brand section ------------------------------------------------->
        <div class="brand__section brand__section-two section--padding pt-0">
            <div class="container">
               @include('layouts.laxmi.brand_logos')
            </div>
        </div>
        <!-- End brand section--------------------------------------------------->

        <!-- Start feature section ---------------------------------------------->
               @include('layouts.laxmi.feature_icons')
        <!-- End feature section ------------------------------------------------>

    </main>

     <!-- Start footer section ------------------------------------------------->
            @include('layouts.laxmi.footer')
    <!-- End footer section ---------------------------------------------------->

    <!-- Quickview Wrapper ---------------------------------------------------->
   @include('layouts.frontendincludes.swipe_featured_quickwrap')
    <!-- Quickview Wrapper End ------------------------------------------------>

     <!-- Scroll top bar ------------------------------------------------------>
   <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
     {{-- ----------------------------------------------------------------- --}}

