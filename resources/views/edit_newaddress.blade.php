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
                                <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">
                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div id="success_message"></div>
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title h3 mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list"><a href="{{ url('my-orders') }}">Dashboard</a></li>
                            <li class="account__menu--list"><a
                                    href="{{ url('view-address/' . auth()->id()) }}">Addresses</a></li>
                            <li class="account__menu--list"><a href="{{ url('wishlist') }}">Wishlist</a></li>
                            <li class="account__menu--list">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="account__wrapper">
                        <div class="account__content">


                            <div class="account__details two">
                                <form action="/updatenewaddress" method="post" class="needs-validation"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control" id="id" name="id"
                                        value="{{ $user->id ?? '' }}" hidden placeholder="Finish">




                                    {{-- Address --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">Address1</label>
                                        <input type="text" class="form-control" id="address"
                                            value="{{ $user->address1 ?? '' }}" name="address1"
                                            placeholder="Address">
                                    </div>

                                     {{-- Address --}}
                                     <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">Address2</label>
                                        <input type="text" class="form-control" id="address"
                                            value="{{ $user->address2 ?? '' }}" name="address2"
                                            placeholder="Address">
                                    </div>

                                    {{-- Phone --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">Phone</label>
                                        <input type="text" class="form-control" id="phone"
                                            value="{{ $user->phone ?? '' }}" name="phone" placeholder="Phone">
                                    </div>

                                    {{-- City --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">City</label>
                                        <input type="text" class="form-control" id="city"
                                            value="{{ $user->city ?? '' }}" name="city" placeholder="City">
                                    </div>

                                    {{-- State --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">State</label>
                                        <input type="text" class="form-control" id="state"
                                            value="{{ $user->state ?? '' }}" name="state" placeholder="State">
                                    </div>

                                    {{-- Country --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">Country</label>
                                        <input type="text" class="form-control" id="country"
                                            value="{{ $user->country ?? '' }}" name="country"
                                            placeholder="Country">
                                    </div>

                                    {{-- Pincode --}}
                                    <div class="form-group py-3 px-2">
                                        <label for="exampleInputPassword4">Pincode</label>
                                        <input type="text" class="form-control" id="pincode"
                                            value="{{ $user->pincode ?? '' }}" name="pincode"
                                            placeholder="Pincode">
                                    </div>




                                    <button id="itemsubmit" type="submit"
                                        class="btn btn-danger waves-effect waves-light">Update</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <!-- my account section end -->

        <!-- Start feature section -->
        @include('layouts.laxmi.feature_icons')
        <!-- End feature section -->

    </main>

    <!-- Start footer section -->
    @include('layouts.laxmi.footer')
    <!-- End footer section -->


    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
