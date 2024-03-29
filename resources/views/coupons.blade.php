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
                        @if(session()->has('message'))
                            <div class="alert alert-success" id="alert">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">LaxmiPriya</a></li>
                                                <li class="breadcrumb-item active">Coupons</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Coupons</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            @if(auth()->user()->is_admin=='1')
                            <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="card" id="tooltip-container">
                                        <div class="card-body">
                                            <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="More Info"></i>
                                            <h4 class="mt-0 font-16">Total Items
                                                <a class="badge bg-info" onclick="newItem();">New</a>
                                            </h4>
                                            {{-- <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$cat_count}}</span></h2> --}}
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @include('entries.addcoupons')
                            @endif




                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>

                                                    <th>Coupon Name</th>
                                                    <th>Code</th>
                                                    <th>Coupon Limit</th>
                                                    <th>Coupon Type</th>
                                                    <th>Coupon Discount Price</th>
                                                    <th>Status</th>
                                                    @if(auth()->user()->is_admin=='1')
														<th>Action</th>
													@endif
                                                </tr>
                                            </thead>

                        <tbody>
						{{-- @foreach(getcategory() as $cat) --}}
                        @foreach($coupons as $coup)
						<tr>
                            {{-- <td>
                              <img style="width:75px; height:75px;" src="" class="mr-2" alt="pic"><a href="items?id="> </a>
                            </td> --}}
                            <td class="align-middle"> {{$coup->offer_name}} </td>
                            <td class="align-middle"> {{$coup->coupon_code}} </td>
                            <td class="align-middle"> {{$coup->coupon_limit}} </td>
                            <td class="align-middle"> {{$coup->coupon_type}} </td>
                            <td class="align-middle"> {{$coup->coupon_price}} </td>
                            {{-- <td class="align-middle"> {{$coup->start_datetime}} </td>
                            <td class="align-middle"> {{$coup->end_datetime}} </td> --}}
                            {{-- <td class="align-middle"> {{$coup->status == '1' ? 'Active' : 'InActive'}} </td> --}}
                            <td class="align-middle">
                               @if ($coup->status == '1')
                                 <label for="" class="badge badge-pill badge-success">Enabled</label>
                               @else
                                 <label for="" class="badge badge-pill badge-danger">Disabled</label>
                               @endif
                            </td>
                            {{-- <td class="align-middle"> {{$coup->visibility_status == '1' ? 'Active' : 'InActive'}} </td> --}}

                            @if(auth()->user()->is_admin=='1')
								<td class="align-middle"> <a class="btn btn-info"
                                     onclick="edititem(`{{$coup->id}}`,`{{$coup->offer_name}}`,`{{$coup->product_id}}`,
                                     `{{$coup->coupon_code}}`,`{{$coup->coupon_limit}}`,`{{$coup->coupon_type}}`,
                                     `{{$coup->coupon_price}}`,`{{$coup->start_datetime}}`,
                                     `{{$coup->end_datetime}}`,`{{$coup->status}}`,`{{$coup->visibility_status}}`);">Edit</a>
                                    <a href="{{url('admin/deletecoupon/'.$coup->id)}}"class="btn btn-danger"
                                         onclick="return confirm('Are you sure you want to Delete?');">Delete</a></td>
                            @endif


                        </tr>
						{{-- @endforeach --}}
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

<script>

function edititem(id,offer_name,product_id,coupon_code,coupon_limit,coupon_type,coupon_price,start_datetime,end_datetime,status,visibility_status) {
    document.getElementById("id").value = id;
    document.getElementById("offer_name").value = offer_name;
    document.getElementById("product_id").value = product_id;
    document.getElementById("coupon_code").value = coupon_code;
    document.getElementById("coupon_limit").value = coupon_limit;
    document.getElementById("coupon_type").value = coupon_type;
    document.getElementById("coupon_price").value = coupon_price;
    document.getElementById("start_datetime").value = start_datetime;
    document.getElementById("end_datetime").value = end_datetime;
    document.getElementById("coup_status").value = status;
    document.getElementById("visibility_status").value = visibility_status;



    document.getElementById("itemsubmit").innerHTML = "Edit";
    document.getElementById("modaltittleadditem").innerHTML = "Edit Item";
    document.getElementById("couponform").action = "\editcoupon";
    $('#addcoupon').modal('show');
}

function newItem() {
    document.getElementById("id").value = "";
    document.getElementById("offer_name").value = "";
    document.getElementById("product_id").value = "";
    document.getElementById("coupon_code").value = "";
    document.getElementById("coupon_limit").value = "";
    document.getElementById("coupon_price").value = "";
    document.getElementById("coupon_type").value = "";
    document.getElementById("start_datetime").value = "";
    document.getElementById("end_datetime").value = "";
    document.getElementById("coup_status").value = "";
    document.getElementById("visibility_status").value = "";
    document.getElementById("itemsubmit").innerHTML = "Add";
    document.getElementById("modaltittleadditem").innerHTML = "Add Item";
    document.getElementById("couponform").action = "\addcoupon";
    $('#addcoupon').modal('show');
}

function myFunction(name,id,description,slug) {
    document.getElementById("id").value = id;
    document.getElementById("slug").value = slug;
    document.getElementById("name").value = name;
    document.getElementById("submit").innerHTML = "Edit";

    document.getElementById("addedit").action = "\editcategory";

    var element = document.getElementById("addeditview");
    element.scrollIntoView({behavior:"smooth"});
}

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script>
    @if (session('message'))
    <script>
       swal("{{ session('message') }}");
    </script>
    @endif
</script> --}}


@include('layouts.footer')
