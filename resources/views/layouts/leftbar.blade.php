<!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">
							<li>
                                <a href="/home">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Admin Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="/">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Home </span>
                                </a>
                            </li>

                            @if(auth()->user()->is_admin=='1')
                            <li>
                                <a href="#Admin" data-toggle="collapse">
                                    <i class="mdi mdi-account-details-outline"></i>
                                    <span> Admin</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Admin">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ url('admin/category') }}">Category</a>
                                        </li>
                                        {{-- <li>
                                            <a href="">Sub Category</a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ url('admin/product') }}">Products</a>
                                        </li>

                                        {{--  --}}

                                        {{-- <li>
                                            <a href="">Orders</a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ url('admin/users') }}">Users</a>
                                        </li>

                                        <li>
                                            <a href="{{ url('admin/orders') }}">Orders</a>
                                        </li>

                                        <li>
                                            <a href="/admin/viewcontacts">Contacts</a>
                                        </li>
                                        {{-- <li>
                                            <a href="/">Front Page</a>
                                        </li> --}}

                                        {{-- <li>
                                            <a href="">Size</a>
                                        </li> --}}

                                        {{-- <li>
                                            <a href="/freenumbers"> </a>
                                        </li>
                                        <li>
                                            <a href="/catlogs"></a>
                                        </li> --}}

                                    </ul>
                                </div>
                            </li>


							@endif


                            {{-- <li>
                                <a href="#dealer" data-toggle="collapse">
                                    <i class="mdi mdi-account-details-outline"></i>
                                    <span> Category</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="dealer">
                                    <ul class="nav-second-level">
                                    </ul>
                                </div>
                            </li> --}}


                          {{-- <div class="collapse" id="dealer">
                                <ul class="nav-second-level"> --}}
                                {{-- @foreach(getcategory() as $cat) --}}
                                    {{-- <li> --}}
                                        {{-- <a href="/category?id={{$cat->id}}">{{$cat->name}}</a> --}}
                                        {{-- <a href=""></a> --}}
                                    {{-- </li> --}}
                                {{-- @endforeach --}}

                                {{-- </ul>
                            </div> --}}

                            {{-- <li>
                                <a href="#dealer" data-toggle="collapse"> --}}
                                    {{-- <i class="mdi mdi-account-details-outline"></i>
                                    <span> Products</span>
                                    <span class="menu-arrow"></span>
                                </a> --}}
                                {{-- <div class="collapse" id="dealer">
                                    <ul class="nav-second-level"> --}}
                                        {{-- @foreach(getproduct() as $prod)
                                        <li>
                                            <a href="/product?id={{$prod->id}}">{{$prod->name}}</a>
                                        </li>
                                    @endforeach --}}
{{--
                                    </ul>
                                </div>
                            </li> --}}















                            {{-- <li>
                                <a href="/qoutations">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Quotations </span>
                                </a>
                            </li> --}}
							                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
