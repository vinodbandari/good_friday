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
                                                <li class="breadcrumb-item active">Products</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Products</h4>
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
                                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$prod_count}}</span></h2>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @include('entries.additemwithproduct')
                            @endif




                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>

                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Selling Price</th>
                                                    <th>Qty</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Gender</th>
                                                    <th>Product Belongs To</th>
                                                    <th>Onsale Status</th>
                                                    @if(auth()->user()->is_admin=='1')
														<th>Action</th>
													@endif
                                                </tr>
                                            </thead>

                        <tbody>
						{{-- @foreach(getcategory() as $cat) --}}
                        @foreach($products as $prod)
						<tr>
                            {{-- <td>
                              <img style="width:75px; height:75px;" src="" class="mr-2" alt="pic"><a href="items?id="> </a>
                            </td> --}}
                            <td class="align-middle"> {{$prod->name}} </td>
                            <td class="align-middle">{{$prod->category->name}}</td>
                            <td class="align-middle">{{$prod->selling_price}}</td>
                            <td class="align-middle">{{$prod->qty}}</td>
                            <td>
                              <img style="width:75px; height:75px;" src="{{asset('assets/uploads/products/'.$prod->image)}}" class="mr-2" alt="pic"><a href="product?id={{$prod->id}}"> </a>
                            </td>

                            <td class="align-middle">{{$prod->status == '1' ? 'Active' : 'InActive'}}</td>

                            <td class="align-middle">
                                @if($prod->gender == '0')
                                 Female
                                 @elseif($prod->gender == '1')
                                  Male
                                 @elseif($prod->gender == '2')
                                  Unisex
                                @endif
                            </td>


                            <td class="align-middle">
                                @if($prod->trending == '0')
                                Mini Featured2 Product
                                 @elseif($prod->trending == '1')
                                 Trending Product
                                 @elseif($prod->trending == '2')
                                 Mini Featured1 Product
                                @endif
                            </td>
                            <td class="align-middle">{{$prod->onsale_products == '1' ? 'Active' : 'InActive'}}</td>
							{{-- <td class="align-middle">  </td> --}}
                            {{-- <td class="align-middle"> {{$cat->gst}} </td> --}}

                            @if(auth()->user()->is_admin=='1')
								<td class="align-middle"> <a class="btn btn-info"
                                     onclick="edititem(`{{$prod->id}}`,`{{$prod->name}}`,`{{$prod->cate_id}}`,`{{$prod->slug}}`,`{{$prod->description}}`,`{{$prod->stone_name}}`,`{{$prod->weight}}`,`{{$prod->small_description}}`,`{{$prod->original_price}}`,`{{$prod->selling_price}}`,`{{$prod->qty}}`,`{{$prod->status}}`,`{{$prod->gender}}`,`{{$prod->trending}}`,`{{$prod->onsale_products}}`);">Edit</a>
                                    <a href="{{url('admin/deleteproduct/'.$prod->id)}}"class="btn btn-danger"
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

function edititem(id,name,cate_id,slug,description,stone_name,weight,small_description,original_price,selling_price,qty,status,gender,trending,onsale_products) {
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("cate_id").value = cate_id;
    document.getElementById("slug").value = slug;
    document.getElementById("description").value = description;
    document.getElementById("stone_name").value = stone_name;
    document.getElementById("weight").value = weight;
    document.getElementById("small_description").value = small_description;
    document.getElementById("original_price").value = original_price;
    document.getElementById("selling_price").value = selling_price;
    document.getElementById("qty").value = qty;
    document.getElementById("gendstatus").value = gender;
    document.getElementById("onsalestatus").value = onsale_products;
    document.getElementById("prodtrending").value = trending;
    document.getElementById("onsalestatus").value = onsale_products;






    document.getElementById("itemsubmit").innerHTML = "Edit";
    document.getElementById("modaltittleadditem").innerHTML = "Edit Item";
    document.getElementById("productform").action = "\editproduct";
    $('#addproduct').modal('show');
}

function newItem() {
    document.getElementById("id").value = "";
    document.getElementById("name").value = "";
    document.getElementById("cate_id").value = "";
    document.getElementById("slug").value = "";
    document.getElementById("description").value = "";
    document.getElementById("stone_name").value = "";
    document.getElementById("weight").value = "";
    document.getElementById("small_description").value = "";
    document.getElementById("original_price").value = "";
    document.getElementById("selling_price").value = "";
    document.getElementById("qty").value = "";
    document.getElementById("prodstatus").value = "";
    document.getElementById("gendstatus").value = "";
    document.getElementById("prodtrending").value = "";


    document.getElementById("itemsubmit").innerHTML = "Add";
    document.getElementById("modaltittleadditem").innerHTML = "Add Item";
    document.getElementById("productform").action = "\addproduct";
    $('#addproduct').modal('show');
}

function myFunction(name,id,cate_id,slug,description,small_description,original_price,selling_price,qty,status) {
    document.getElementById("id").value = id;
    document.getElementById("slug").value = slug;
    document.getElementById("name").value = name;
    document.getElementById("cate_id").value = cate_id;
    document.getElementById("description").value = description;
    document.getElementById("small_description").value = small_description;

    document.getElementById("original_price").value = original_price;
    document.getElementById("selling_price").value = selling_price;
    document.getElementById("qty").value = qty;
    document.getElementById("prodstatus").value = status;
    document.getElementById("submit").innerHTML = "Edit";

    document.getElementById("addedit").action = "\editproduct";

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
