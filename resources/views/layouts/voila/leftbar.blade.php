<!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">
							<li>
                                <a href="/home">
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
                                            <a href="/category">Category</a>
                                        </li>
                                        <li>
                                            <a href="/dailystock">Daily Stock</a>
                                        </li>
                                        <!-- <li>
                                            <a href="/ratecode">Symbol Coding</a>
                                        </li>
                                        <li>
                                            <a href="/settings">Setting</a>
                                        </li> -->

                                        <li>
                                            <a href="/clients">Clients</a>
                                        </li>

                                        <li>
                                            <a href="/freenumbers">Free Numbers</a>
                                        </li>

                                        <li>
                                            <a href="/superadmin">Super Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


							@endif


                            <li>
                                <a href="#dealer" data-toggle="collapse">
                                    <i class="mdi mdi-account-details-outline"></i>
                                    <span> Category</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="dealer">
                                    <ul class="nav-second-level">
                                    @foreach(getcategory() as $cat)
                                        <li>
                                            <a href="/items?id={{$cat->id}}">{{$cat->name}}</a>
                                        </li>
                                    @endforeach

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="/qoutations">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Quotations </span>
                                </a>
                            </li>
							                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
