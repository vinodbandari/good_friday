@include('layouts.header')
@include('layouts.topbar')
@include('layouts.leftbar')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<div id="wrapper">

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LaxmiPriya</a></li>
                                    <li class="breadcrumb-item active">User Details</li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('admin/users') }}"
                                            class="btn btn-success btn-sm float-end">Back</a>
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">User Details</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="">Role</label>
                                <div class="p-2 border">{{ $users->is_admin == '0' ? 'User' : 'Admin' }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">First Name</label>
                                <div class="p-2 border">{{ $users->name }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Last Name</label>
                                <div class="p-2 border">{{ $users->lname }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Email</label>
                                <div class="p-2 border">{{ $users->email }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Phone</label>
                                <div class="p-2 border">{{ $users->phone }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Address1</label>
                                <div class="p-2 border">{{ $users->address1 }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Address2</label>
                                <div class="p-2 border">{{ $users->address2 }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">City</label>
                                <div class="p-2 border">{{ $users->city }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">State</label>
                                <div class="p-2 border">{{ $users->state }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Country</label>
                                <div class="p-2 border">{{ $users->name }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Pin Code</label>
                                <div class="p-2 border">{{ $users->pincode }}</div>
                            </div>
                            {{-- end row --}}
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->

</div>


</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->




@include('layouts.footer')
