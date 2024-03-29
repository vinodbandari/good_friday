<div class="offcanvas__header">
    <div class="offcanvas__inner">
        <div class="offcanvas__logo">
            <a class="offcanvas__logo_link" >
                <img src="{{ asset('bcute/img/logo/nav-log.webp') }}" alt="Logo-img" width="158" height="36">
            </a>
            <button class="offcanvas__close--btn" data-offcanvas>close</button>
        </div>
        <nav class="offcanvas__menu">
            <ul class="offcanvas__menu_ul">
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="/">Home</a>
                </li>
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="/shopping">Shop</a>
                </li>
                <li class="offcanvas__menu_li">
                    {{-- <a class="offcanvas__menu_item" href="#">Pages</a> --}}
                    <ul class="offcanvas__sub_menu">
                        {{-- <li class="offcanvas__sub_menu_li"><a href="/about" class="offcanvas__sub_menu_item">About Us</a></li> --}}
                        <li class="offcanvas__sub_menu_li"><a href="/contact" class="offcanvas__sub_menu_item">Contact Us</a></li>
                        <li class="offcanvas__sub_menu_li"><a href="/cart" class="offcanvas__sub_menu_item">Cart Page</a></li>
                        {{-- <li class="offcanvas__sub_menu_li"><a href="portfolio.html" class="offcanvas__sub_menu_item">Portfolio Page</a></li> --}}
                        <li class="offcanvas__sub_menu_li"><a href="/wishlist" class="offcanvas__sub_menu_item">Wishlist Page</a></li>
                        {{-- <li class="offcanvas__sub_menu_li"><a href="" class="offcanvas__sub_menu_item">Login Page</a></li> --}}
                        {{-- <li class="offcanvas__sub_menu_li"><a href="404.html" class="offcanvas__sub_menu_item">Error Page</a></li> --}}
                    </ul>
                </li>
                {{-- <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="/about">About</a></li>
                <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="/contact">Contact</a></li> --}}
            </ul>
            <div class="offcanvas__account--items">
                {{-- <a class="offcanvas__account--items__btn d-flex align-items-center" href="login.html">
                    <span class="offcanvas__account--items__icon">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="20.51" height="19.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                    </span>
                    <span class="offcanvas__account--items__label">Login / Register</span>
                </a> --}}
                @guest
                @if (Route::has('login'))

                        <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('login') }}">
                            <span class="offcanvas__account--items__icon">
                                <svg xmlns="http://www.w3.org/2000/svg"  width="20.51" height="19.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                            </span>
                            <span class="offcanvas__account--items__label">Login / Register</span>
                        </a>

                @endif


            @else
                {{-- <li class="nav-item dropdown"> --}}
                    <a  class="offcanvas__account--items__btn d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="offcanvas__account--items__icon">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="20.51" height="19.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                        </span>
                        <span class="offcanvas__account--items__label">{{ Auth::user()->name }}</span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                {{-- </li> --}}
            @endguest
            </div>
        </nav>
    </div>
</div>
