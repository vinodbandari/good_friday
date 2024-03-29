<!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">









                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search"></i>
                               </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                <form action="/search" method="get" class="needs-validation">
                                <input type="text" class="form-control" id="key" name="key" placeholder="Search">
                                <input type="submit" style="visibility:hidden;position:absolute" />
                                </form>
                                </div>




                                <!-- All-->


                            </div>
                        </li>

                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-shopping-cart"></i>
                               </a>
                            <div id='cart' class="dropdown-menu dropdown-menu-right dropdown-lg" style="width: 415px !important;">
                                <div class="dropdown-item noti-title">
                                    <div class="noti-scroll" data-simplebar>
                                @if(session('cart')!=null)

                            @include('cart')


                                    </div>
                                    <div style="text-align: center;">
                                    <a class="btn btn-success" href="/qout" class="text-dark" style="display: -webkit-inline-box;">
                                        Make Qoutation
                                    </a>
                                    <a class="btn btn-danger" href="/clearqout" class="text-dark" style="display: -webkit-inline-box;">
                                        Clear Qoutation
                                    </a>
                                </div>
                                    @else
                                    {{print_r(session('cart'))}}
                                    @endif
                                </div>
                            </div>
                        </li>


                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
								{{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="/myaccount" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->


                                <div class="dropdown-divider"></div>

                                <!-- item-->
								<form method="POST" action="{{ route('logout') }}">
                            @csrf
							<input type="hidden" name="name" value="value" />
							<a onclick="this.parentNode.submit();" class="dropdown-item notify-item"><i class="fe-log-out"></i>Logout
                        </a>
						</form>



                            </div>
                        </li>



                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="/" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="" alt="" height="50">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="" alt="" height="50">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>

                        <a href="/" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>


</ul>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->
