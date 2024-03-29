
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
                            <li class="account__menu--list"><a href="{{url('view-address/'.auth()->id())}}">Addresses</a></li>
                            <li class="account__menu--list"><a href="{{ url('wishlist') }}">Wishlist</a></li>
                            <li class="account__menu--list">
                                <a  href="{{ route('logout') }}"
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

                    @php
                        $i=0;
                    @endphp
                    <div class="account__wrapper">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Addresses  </h2>
                            {{-- <button class="new__address--btn primary__btn mb-25" type="button" data-bs-toggle="modal" data-bs-target="#AddAddressModal">Add a new address</button> --}}
                            <a href="/newaddress" class="new__address--btn primary__btn mb-25" type="button">Add a new address</a>

                            @foreach ($new_address as $addr)
                                <div class="account__details two">


                                    <h3 class="account__details--title h4">Address{{ $loop->iteration }}</h3>
                                    <p class="account__details--desc">{{ $addr->address1 }} <br>{{ $addr->city }}  <br> {{ $addr->state }} <br> {{ $addr->country }}</p>


                                    {{-- <a class="account__details--link" href="">View Addresses()</a> --}}

                                </div>
                                <div class="account__details--footer d-flex">
                                    {{-- <button class="account__details--footer__btn" data-bs-toggle="modal" data-bs-target="#AddAddressModal" type="button" >Edit</button> --}}

                                    <a href="{{ url('editnewaddress/'.$addr->id) }}" class="account__details--footer__btn" type="button">Edit</a>
                                    {{-- <button class="account__details--footer__btn" type="button">Delete</button><br><br><br><br> --}}
                                    <form action="{{ url('deletenewaddress/'.$addr->id) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="account__details--footer__btn" type="submit">Delete</button> <br> <br>


                                    </form>

                                    <form action="{{ url('default/'.$addr->id) }}" method="post">
                                        @csrf
                                        <button class="account__details--footer__btn " type="submit" name="default">Default</button>
                                      </form>



                                </div>
                            @endforeach




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
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>

