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
                                                <li class="breadcrumb-item active">Orders</li>
                                                <li class="breadcrumb-item"><a href="{{url('order-history')}}" class="btn btn-warning float-end">Order History</a></li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Orders</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->


                                <div class="card">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success" id="alert">
                                        {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Order Date</th>
                                                    <th>Tracking Number</th>
                                                    <th>Total Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orders as $item )
                                                <tr>
                                                    <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                                                    <td>{{$item->tracking_no}}</td>
                                                    <td>{{$item->total_price}}</td>
                                                    {{-- <td>{{$item->status == '0'? 'pending' : 'completed'}}</td> --}}
                                                    <td>
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

                                                    <td>
                                                        <a href="{{url('admin/view-order/'.$item->id)}}" class="btn btn-primary">View</a>
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
