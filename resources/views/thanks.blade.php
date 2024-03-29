
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
                                <li class="breadcrumb__content--menu__items"><span>Thanks</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start checkout page area -->

                    <div class="col-lg-12 col-md-12">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Thank You </h2>

                            <p class="text-center mb-2">Your order is successfully placed,It will take 2-3working days to deliver</p>
                            <div class="cart__table checkout__product--table">

                                <a class="primary__btn slider__btn float-end" href="/">
                                    Continue Shopping
                                    <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.9732 5.19375L11.1893 0.460018C11.1225 0.392216 11.0412 0.338185 10.9507 0.301395C10.8601 0.264605 10.7623 0.245867 10.6636 0.246372C10.5648 0.246877 10.4672 0.266615 10.377 0.304329C10.2869 0.342044 10.2061 0.396903 10.14 0.465385C10.001 0.610077 9.9245 0.79778 9.92549 0.992021C9.92649 1.18626 10.0049 1.37316 10.1454 1.51643L13.6531 4.9864L0.935903 5.05145C0.734471 5.06613 0.546408 5.15137 0.409525 5.29006C0.272641 5.42874 0.197086 5.61057 0.19805 5.799C0.199014 5.98743 0.276425 6.16848 0.41472 6.30575C0.553015 6.44303 0.74194 6.52635 0.943512 6.53896L13.6586 6.47392L10.1866 9.98155C10.0475 10.1262 9.97108 10.3139 9.97207 10.5082C9.97306 10.7024 10.0514 10.8893 10.192 11.0326C10.2588 11.1004 10.3401 11.1544 10.4306 11.1912C10.5212 11.228 10.6189 11.2467 10.7177 11.2462C10.8165 11.2457 10.9141 11.226 11.0042 11.1883C11.0944 11.1506 11.1751 11.0957 11.2413 11.0272L15.9786 6.25458C16.1206 6.1093 16.1989 5.91956 16.1979 5.72303C16.1969 5.5265 16.1167 5.33757 15.9732 5.19375Z" fill="currentColor"></path>
                                    </svg>
                                </a>



                            </div>

                            {{-- <a href="" class="checkout__now--btn primary__btn float-left">HEllo</a> --}}







                            {{-- C H E C K O U T   B U T T O N --}}
                            {{-- <a type="submit" class="checkout__now--btn primary__btn">Checkout Now</a> --}}
                            {{-- <button class="checkout__now--btn primary__btn" type="submit">Checkout Now</button> --}}

                        </aside>
                    </div>
                    {{-- O R D E R    S U M M A R Y    E N D S---------------------------------------------------------------------- --}}

                    {{-- I F    N O    O R D E R S------------------------------------------------------------------------------ --}}

        <!-- End checkout page area -->

        <!-- Start feature section -->
       {{-- <section class="feature__section section--padding pt-0">
            <div class="container">
                @include('layouts.laxmi.feature_icons')
            </div>
        </section> --}}
        <!-- End feature section -->
    </main>

    <!-- Start footer section -->
           @include('layouts.laxmi.footer')
    <!-- End footer section -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
