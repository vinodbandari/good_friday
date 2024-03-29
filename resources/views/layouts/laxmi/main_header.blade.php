<div class="main__header position__relative header__sticky">
    <div class="container">
        <div class="main__header--inner d-flex justify-content-between align-items-center">
            <div class="offcanvas__header--menu__open ">
                <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/></svg>
                    <span class="visually-hidden">Offcanvas Menu Open</span>
                </a>
            </div>
            <div class="main__logo">
                <h1 class="main__logo--title"><a class="main__logo--link" >
                    <img class="main__logo--img" src="{{ asset('bcute/img/logo/nav-log.webp') }}" alt="logo-img">
                </a></h1>
            </div>
            <div class="header__menu d-none d-lg-block">
                <nav class="header__menu--navigation">
                    <ul class="header__menu--wrapper d-flex">
                        <li class="header__menu--items">
                            <a class="header__menu--link active" href="{{ url('/') }}">Home
                                {{-- <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12" height="7.41" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg> --}}
                            </a>

                        </li>

                        <li class="header__menu--items">
                            {{-- <a class="header__menu--link " href="">Shop
                                <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12" height="7.41" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                            </a> --}}
                            <ul class="header__sub--menu">
                                {{-- <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="product-details.html">Product Details</a></li> --}}
                                            {{-- <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="product-details.html">Trending Product</a></li> --}}
                                            {{-- @if(Auth::user()->is_admin == '1') --}}
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('my-orders') }}">My Account</a></li>

                                            {{-- @elseif (Auth::user()->is_admin == '0')
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('my-orders') }}">My Account</a></li>
                                            @endif --}}
                                            {{-- <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="my-account-2.html">My Account 2</a></li> --}}
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('cart') }}">Cart Page</a></li>
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('wishlist') }}">Wishlist</a></li>
                                            @if(Auth::user())
                                            <li class="header__mega--sub__menu_li">
                                                <a class="header__mega--sub__menu--title"  href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                Log Out
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                            @else
                                            <a class="header__mega--sub__menu--title" href="{{ route('login') }}">Login Page</a>
                                            @endif
                                            </li>
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('checkout') }}">Checkout</a></li>
                                            <li class="header__mega--sub__menu_li"><a class="header__mega--sub__menu--title" href="{{ url('cart') }}">View cart</a></li>

                            </ul>
                        </li>

                        <li class="header__menu--items">
                            <a class="header__menu--link" href="/shopping">Accesories </a>
                        </li>

                        <li class="header__menu--items">
                            {{-- <a class="header__menu--link" href="#">Pages
                                <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12" height="7.41" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                            </a> --}}
                            <ul class="header__sub--menu">
                                <li class="header__sub--menu__items"><a href="/about" class="header__sub--menu__link">About Us</a></li>
                                <li class="header__sub--menu__items"><a href="/contact" class="header__sub--menu__link">Contact Us</a></li>
                                {{-- @if(Auth::user()->is_admin == '1')
                                <li class="header__sub--menu__items"><a href="/admin/viewcontacts" class="header__sub--menu__link">View Contacts</a></li>
                                @elseif(Auth::user()->is_admin == '0')
                                <li class="header__sub--menu__items"><a href="" class="header__sub--menu__link">hai</a></li>
                                @endif --}}
                                <li class="header__sub--menu__items"><a href="{{ url('cart') }}" class="header__sub--menu__link">Cart Page</a></li>
                                {{-- <li class="header__sub--menu__items"><a href="portfolio.html" class="header__sub--menu__link">Portfolio Page</a></li> --}}
                                <li class="header__sub--menu__items"><a href="{{ url('wishlist') }}" class="header__sub--menu__link">Wishlist Page</a></li>
                                <li class="header__sub--menu__items"><a href="/privacy_policies" class="header__sub--menu__link">Privacy Policy</a></li>
                                @if(Auth::user())
                                <li class="header__sub--menu__items">
                                    <a class="header__sub--menu__link"  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Log Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form></li>
                                @else
                                <li class="header__sub--menu__items"><a href="{{ route('login') }}" class="header__sub--menu__link">Login Page</a></li>
                                @endif
                                {{-- <li class="header__sub--menu__items"><a href="404.html" class="header__sub--menu__link">Error Page</a></li> --}}
                            </ul>
                        </li>
                        <li class="header__menu--items">
                            <a class="header__menu--link" href="/contact">Contact </a>
                        </li>

                        {{-- @if(Auth::user()->is_admin == 1)
                        <li class="header__menu--items">
                            <a class="header__menu--link" href="/home">Admin-Dashboard </a>
                        </li>
                        @endif --}}
                    </ul>
                </nav>
            </div>
            <div class="header__account">
                <ul class="header__account--wrapper d-flex align-items-center">
                    <li class="header__account--items  header__account--search__items d-none d-lg-block">
                        <a class="header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                            <span class="header__account--btn__icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 16L11 11M12.6667 6.83333C12.6667 7.59938 12.5158 8.35792 12.2226 9.06565C11.9295 9.77339 11.4998 10.4164 10.9581 10.9581C10.4164 11.4998 9.77339 11.9295 9.06565 12.2226C8.35792 12.5158 7.59938 12.6667 6.83333 12.6667C6.06729 12.6667 5.30875 12.5158 4.60101 12.2226C3.89328 11.9295 3.25022 11.4998 2.70854 10.9581C2.16687 10.4164 1.73719 9.77339 1.44404 9.06565C1.15088 8.35792 1 7.59938 1 6.83333C1 5.28624 1.61458 3.80251 2.70854 2.70854C3.80251 1.61458 5.28624 1 6.83333 1C8.38043 1 9.86416 1.61458 10.9581 2.70854C12.0521 3.80251 12.6667 5.28624 12.6667 6.83333Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Search</span>
                        </a>
                    </li>
                    <li class="header__account--items">
                        <a class="header__account--btn d-sm-2-none" href="{{ url('wishlist') }}">
                            <span class="header__account--btn__icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.09836 2.28681C1.75014 2.69477 1.47391 3.1791 1.28545 3.71213C1.097 4.24516 1 4.81646 1 5.39341C1 5.97036 1.097 6.54167 1.28545 7.0747C1.47391 7.60773 1.75014 8.09206 2.09836 8.50002L8.50001 16L14.9016 8.50002C15.6049 7.6761 16 6.55862 16 5.39341C16 4.22821 15.6049 3.11073 14.9016 2.28681C14.1984 1.46289 13.2446 1.00001 12.25 1.00001C11.2554 1.00001 10.3016 1.46289 9.59833 2.28681L8.50001 3.57358L7.40168 2.28681C7.05346 1.87884 6.64006 1.55522 6.18509 1.33443C5.73011 1.11364 5.24248 1 4.75002 1C4.25756 1 3.76992 1.11364 3.31495 1.33443C2.85998 1.55522 2.44658 1.87884 2.09836 2.28681V2.28681Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            {{-- <span class="visually-hidden wishlist-count">Wishlist</span> --}}
                            <span class="wishlist-count">0</span>
                        </a>
                    </li>
                    <li class="header__account--items">
                        <a class="header__account--btn d-sm-2-none" href="{{ url('my-orders') }}">
                            <span class="header__account--btn__icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 16V14.3333C16 13.4493 15.6049 12.6014 14.9016 11.9763C14.1984 11.3512 13.2446 11 12.25 11H4.75C3.75544 11 2.80161 11.3512 2.09835 11.9763C1.39509 12.6014 1 13.4493 1 14.3333V16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.5 7.66667C10.5711 7.66667 12.25 6.17428 12.25 4.33333C12.25 2.49238 10.5711 1 8.5 1C6.42893 1 4.75 2.49238 4.75 4.33333C4.75 6.17428 6.42893 7.66667 8.5 7.66667Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">My Account</span>
                        </a>
                    </li>
                    <li class="header__account--items header__minicart--items">
                        <a class="header__account--btn minicart__open--btn" href="javascript:void(0)" data-offcanvas>
                            <span class="header__account--btn__icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.25 7.66667V4.33333C12.25 3.44928 11.8549 2.60143 11.1517 1.97631C10.4484 1.35119 9.49456 1 8.5 1C7.50544 1 6.55161 1.35119 5.84835 1.97631C5.14509 2.60143 4.75 3.44928 4.75 4.33333V7.66667M1.9375 6H15.0625L16 16H1L1.9375 6Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="cart-count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
