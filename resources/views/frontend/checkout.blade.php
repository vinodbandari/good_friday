
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
                                <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <!-- End breadcrumb section -->

        <!-- Start checkout page area -->
         @include('layouts.frontendincludes.checkout_page_details')
        <!-- End checkout page area -->

        <!-- Start feature section -->
       <section class="feature__section section--padding pt-0">
            <div class="container">
                @include('layouts.laxmi.feature_icons')
            </div>
        </section>
        <!-- End feature section -->
    </main>

    <!-- Start footer section -->
           @include('layouts.laxmi.footer')
    <!-- End footer section -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
