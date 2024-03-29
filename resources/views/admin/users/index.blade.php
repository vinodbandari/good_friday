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
                                                <li class="breadcrumb-item active">Registered users</li>
                                                {{-- <li class="breadcrumb-item">
                                                    <a href="{{url('orders')}}" class="btn btn-warning float-end">New Orders</a>
                                                </li> --}}
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Registered users</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->


                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $item)
                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->name.''.$item->lname}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>
                                                        <a href="{{url('admin/view-user/'.$item->id)}}" class="btn btn-primary">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>

										</table>

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
