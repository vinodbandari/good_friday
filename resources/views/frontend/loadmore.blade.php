@include('layouts.laxmi.header')


<body>
    
    <!-- Start preloader -->
    @include('layouts.laxmi.preloader')
    <!-- End preloader -->

    <!-- Start offcanvas filter sidebar -->
    <div class="offcanvas__filter--sidebar widget__area">
        <button type="button" class="offcanvas__filter--close" data-offcanvas>
            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg> <span class="offcanvas__filter--close__text">Close</span>
        </button>
        <div class="offcanvas__filter--sidebar__inner">

            {{-- C A T E G O R I E S     S I D E B A R --}}
            {{-- start categories sidebar --}}
            @include('layouts.frontendincludes.categorysidebar')
            {{-- end category sidebar --}}



            {{-- D I E T A R Y  N E E D S --}}
            {{-- start dietary needs --}}
            @include('layouts.frontendincludes.dietaryneeds')
            {{-- end dietary needs --}}

            {{-- F I L T E R  B Y  P R I C E --}}
            {{-- start filter by price --}}
            @include('layouts.frontendincludes.filterbyprice')
            {{-- end filter by price --}}

            {{-- T O P   R A T E D  P R O D U C T --}}
            {{-- start top rated product --}}
            @include('layouts.frontendincludes.topratedprod')
            {{-- end top rated product --}}


            {{-- B R A N D S --}}
            {{-- start brands --}}
            @include('layouts.frontendincludes.brands')
            {{-- endbrands --}}


        </div>
    </div>
    <!-- End offcanvas filter sidebar -->

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

        {{-- M I N I   C A R T --}}
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
                            <h1 class="breadcrumb__content--title">Product</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->


        <!-- Start collection section -->
        @include('layouts.frontendincludes.shopbycategory')
        <!-- End collection section -->

        <!-- Start shop section -->
        <div class="shop__section section--padding pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                        <div class="shop__sidebar--widget widget__area d-none d-lg-block">

                            {{-- C A T E G O R I E S      S I D E B A R --}}
                            @include('layouts.frontendincludes.categorysidebar')
                            {{-- END OF CATEGORIES SIDEBAR --}}


                            {{-- GENDEFR SORT --}}
                            @include('layouts.frontendincludes.gendsidebar')
                            {{-- END OGENDER SORT --}}

                            {{-- F I L T E R   B Y  P R I C E --}}
                            @include('layouts.frontendincludes.filterbyprice')
                            {{-- end filter by price --}}


                            {{-- T O P   R A T E D     P R O D U C T S --}}
                            @include('layouts.frontendincludes.topratedprod')
                            {{-- end toprated products --}}


                            {{-- B R A N D S --}}
                            {{-- @include('layouts.frontendincludes.brands') --}}
                            {{-- end of brands --}}

                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                        <div class="shop__product--wrapper position__sticky">

                            @include('layouts.frontendincludes.shopping_sortby')

                            {{-- T A B   C O N T E N T --}}
                            <div class="tab_content">

                                {{-- L I S T   V I E W --}}
                                {{-- list view starts --}}
                                @include('layouts.frontendincludes.listview')
                                {{-- list view ends --}}
                            </div>


                            {{-- P A G I N A T I O N --}}
                            {{-- start pagination --}}
                            @include('layouts.frontendincludes.pagination')
                            {{-- end pagination --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End shop section -->

        <!-- Start feature section -->
        @include('layouts.laxmi.feature_icons')
        <!-- End feature section -->

    </main>

    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section -->

    <!-- Quickview Wrapper -->
    @include('layouts\frontendincludes\quickwrapper')
    <!-- Quickview Wrapper End -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>



    {{-- --------------------------------------------------------------------------------------------------------------- --}}
