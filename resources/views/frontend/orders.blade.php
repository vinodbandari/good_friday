
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
                @if(Auth::user()->is_admin == '1')
                <p class="account__welcome--text">Hello, {{ Auth::user()->name }} welcome to your dashboard!</p>
                @elseif(Auth::user()->is_admin == '0')
                <p class="account__welcome--text">Hello, {{ Auth::user()->name }}  welcome to your dashboard!</p>
                @endif


                {{-- M Y   P R O F I L E    L I S T --}}
                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title mb-20">My Profile</h2>
                        <ul class="account__menu">


                            <li class="account__menu--list active"><a href="/my-orders">Dashboard</a></li>

                            @if(Auth::user()->is_admin == '1')
                            <li class="account__menu--list "><a href="/home">Admin</a></li>
                            @else
                            {{-- <h5>hello</h5> --}}
                            @endif

                            {{-- <li class="account__menu--list"><a href="{{url('view-address/'.auth()->id())}}">Addresses</a></li> --}}


                            <li class="account__menu--list"><a href="/wishlist">Wishlist</a></li>
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
                    {{-- @include('layouts.laxmi.orders_menu') --}}


                    {{-- O R D E R   H I S T O R Y --------------------------------------------- --}}
                    <div class="account__wrapper">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Orders History</h2>
                            <div class="account__table--area">
                                <table class="account__table">
                                    @if($orders->count() > 0)
                                    <thead class="account__table--header">
                                        <tr class="account__table--header__child">
                                            <th class="account__table--header__child--items">Order</th>
                                            <th class="account__table--header__child--items">Date</th>
                                            <th class="account__table--header__child--items">Order Status</th>
                                            {{-- <th class="account__table--header__child--items">Fulfillment Status</th> --}}
                                            <th class="account__table--header__child--items">Total</th>
                                        </tr>
                                    </thead>
                                    @else
                                     <div class="card" style="background-color: silver">
                                        <div class="card-header">
                                            <h3 class="text-center">No Orders Found</h3>
                                        </div>
                                     </div>
                                    @endif
                                    <tbody class="account__table--body mobile__none">
                                        @foreach($orders as $item)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">{{ $item->tracking_no }}</td>
                                            <td class="account__table--body__child--items">{{ date('d-M-Y', strtotime($item->created_at)) }}</td>
                                            {{-- <td class="account__table--body__child--items">{{$item->status == '0'? 'pending' : 'completed'}}</td> --}}
                                            {{-- <td class="account__table--body__child--items">Unfulfilled</td> --}}
                                            <td class="account__table--body__child--items">
                                                @if($item->status == '0')
                                                 pending
                                                @elseif($item->status == '1')
                                                 completed
                                                @elseif($item->status == '2')
                                                 Payment is pending
                                                @elseif($item->status == '3')
                                                 shipped
                                                @elseif($item->status == '4')
                                                 cancelled
                                                @elseif($item->status == '5')
                                                 out-for-delivery
                                                @endif

                                            </td>
                                            <td class="account__table--body__child--items">Rs.{{ $item->total_price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my account section end -->

        {{-- F E A T U R E   I C O N S ----------------------------------------------------------------- --}}
        <!-- Start feature section -->
                @include('layouts.laxmi.feature_icons')
        <!-- End feature section -->

    </main>

    {{-- F O O T E R --------------------------------------------------------------------------------- --}}
   <!-- Start footer section -->
           @include('layouts.laxmi.footer')
    <!-- End footer section -->

    {{-- T O P   B A R ------------------------------------------------------------------------------- --}}
    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>


