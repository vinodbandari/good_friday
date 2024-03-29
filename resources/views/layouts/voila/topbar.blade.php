<body id="index" class="lang-en country-in currency-inr layout-full-width page-index tax-display-enabled
           displayhomenovone">



        <main id="main-site">




                                    <header id="header" class="header-1 sticky-menu">

        <div class="header-center hidden-sm-down">
            <div class="container-fluid">
                <div class="row d-flex align-items-center">

                        <div id="_desktop_top_menu" class="contentsticky_menu menu-style2 position-static col-md-5">
                            <div id="nov-megamenu" class="clearfix">
    <nav id="megamenu" class="nov-megamenu clearfix">
<ul class="menu level1">
    <li class="item home-page group" ><span class="opener"></span><a href="{{url('/')}}" title="Home">Home</a></li>
    <li class="item home-page group" ><span class="opener"></span><a href="/about" title="Home">About</a></li>
    <li class="item home-page group" ><span class="opener"></span><a href="{{url('categories')}}" title="Home">Categories</a></li>
    <li class="item home-page group" ><span class="opener"></span><a href="/contact" title="Home">Contact</a></li>

</ul>
    </nav>
</div>
                        </div>
                        <div class="col-lg-5 col-md-5 hidden-xl-up">
                            <span class="toggle-megamenu">
                                <i class="zmdi zmdi-sort-amount-desc"></i>
                            </span>
                        </div>

                    <div id="_desktop_logo" class="contentsticky_logo text-center col-md-2 pt-15 pb-15">
                                                    <a href="/">
                                {{-- <img class="logo img-fluid" src="/images/logo.png" alt="Voila"> --}}
                                <img class="logo img-fluid" src="{{asset('uploads/kappaas.png')}}" alt="Voila">
                            </a>
                                            </div>
                    <div class="col-lg-5 col-md-5 d-flex align-items-center justify-content-end header-top-right">
                        <div class="contentsticky_search">
                            <!-- block seach mobile -->
    <!-- Block search module TOP -->
        <div id="_desktop_search_content"
         data-id_lang="1"
         data-ajaxsearch="1"
         data-novadvancedsearch_type="top"
         data-instantsearch=""
         data-search_ssl=""
         data-link_search_ssl="http://localhost/en/search"
         data-action="http://localhost/en/module/novadvancedsearch/result">
        <div class="toggle-search d-flex align-items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="search-ico">
            <g id="Search">
            <circle id="Ellipse_739" cx="11.7666" cy="11.7666" r="8.98856"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path id="Line_181" d="M18.0183 18.4851L21.5423 22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            </g>
            </svg>
            Search
        </div>
        <div id="desktop_search" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="search_close">
                    <i class="zmdi zmdi-close"></i>
                </div>
                <form method="get" action="http://localhost/en/module/novadvancedsearch/result" id="searchbox" class="form-novadvancedsearch">
                    <input type="hidden" name="fc" value="module">
                    <input type="hidden" name="module" value="novadvancedsearch">
                    <input type="hidden" name="controller" value="result">
                    <input type="hidden" name="orderby" value="position" />
                    <input type="hidden" name="orderway" value="desc" />
                    <input type="hidden" name="id_category" class="id_category" value="0" />
                    <div class="input-group input-group-left">
                        <div class="input-group-btn nov_category_tree">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" value="aaaaa" aria-expanded="false">
                                <span>Categories</span>
                            </button>
                            <ul class="dropdown-menu list-unstyled">
                                <li class="dropdown-item active" data-value="0"><span>All Categories</span></li>
                                <li class="dropdown-item " data-value="2"><span>Home</span></li>
                                                                            <li>
                                        <ul class="list-unstyled pl-5">
                                                                                    </ul>
                                    </li>
                                                            </ul >
                        </div>
                        <input type="text" id="search_query_top" class="search_query ui-autocomplete-input form-control" name="search_query" value="" placeholder="Enter your key word"/>
                        <span class="input-group-btn button-search">
                            <button class="btn btn-secondary" type="submit" name="submit_search">Search<i class="fa fa-search"></i></button>
                        </span>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- /Block search module TOP -->

                        </div>
                        <div class="contentsticky_settings">
                            <div id="block_myaccount_infos" class="myaccount_infos groups-selector hidden-sm-down dropdown">
                                <div class="myaccount-title">
                                    <span>Account</span>
                                </div>
                                <div class="account-list">
                                    <div class="account-list-content">
                                      <div>
                                           <a class="login" href="http://127.0.0.1:8000/login"
                                                rel="nofollow" title="Log in to your customer account">
                                                <i class="fa fa-cog"></i>
                                                <span>Log in</span>
                                            </a>

                                      </div>
                                        <div>
                                            <a class="register" href="http://127.0.0.1:8000/register"
                                                rel="nofollow" title="Register Account">
                                                <i class="fa fa-sign-in"></i>
                                                <span>Register</span>
                                            </a>
                                        </div>


                                        <div>
                                            <a class="my-orders" href="http://127.0.0.1:8000/my-orders" rel="nofollow" title="My Orders">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>My Orders</span>
                                            </a>
                                        </div>
                                        <div class="link_wishlist">
                                            {{-- class= "wishlist" --}}
                                            <a href="{{url('wishlist-count')}}" title="My Wishlists">
                                                <i class="fa fa-heart "></i><span>My Wishlists</span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contentsticky_cart">    <div id="_desktop_cart">
        <div class="blockcart cart-preview" data-refresh-url="//localhost/en/module/ps_shoppingcart/ajax">
            <div class="header-cart ">
                <div class="header-cart-icon">
                    <span class="cart-products-count cart-count">0</span>
                    <i class="icon_cart"></i>
                </div>
                <a href="{{url('cart')}}">
                <div class="title-cart label-header"><span>My Cart</span></div>
               </a>
            </div>
            <div class="cart_block ">
                @if (DB::table('carts')->count() <= 0)
                    <div class="no-items">
                        No products in the cart
                    </div>
                @endif



                            </div>
        </div>
    </div>
    </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header-mobile hidden-md-up">
            <div class="hidden-md-up text-xs-center mobile d-flex align-items-center justify-content-end">
                                    <div class="mobile_logo">
                        <a href="/home">
                            <img style="height: 50px;max-width: fit-content;"class="logo-mobile img-fluid" src="/images/logo.png" alt="Voila">
                        </a>
                    </div>
                                <div id="_mobile_search">
                    <div id="_mobile_search_content"></div>
                </div>
                <div id="_mobile_menutop" class="item-mobile-top nov-toggle-page d-flex align-items-center justify-content-center" data-target="#mobile-pagemenu"><i class="zmdi zmdi-view-headline"></i></div>
            </div>
        </div>

</header>

<div id="header-sticky" class="sticky-header-1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 position-static">
                <div class="contentstickynew_menu"></div>
            </div>
            <div class="col-lg-2 col-md-2 text-center">
                <div class="contentstickynew_logo"></div>
            </div>
            <div class="d-flex justify-content-end col-lg-5 col-md-5 style_search1 align-items-center">
                <div class="contentstickynew_search"></div>
                <div class="contentstickynew_settings"></div>
                <div class="contentstickynew_cart"></div>
            </div>
        </div>
    </div>
</div>


