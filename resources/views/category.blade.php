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
                                                <li class="breadcrumb-item active">Category</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Category</h4>
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
                                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$cat_count}}</span></h2>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @include('entries.additemwithdealer')
                            @endif




                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>

                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    @if(auth()->user()->is_admin=='1')
														<th>Action</th>
													@endif
                                                </tr>
                                            </thead>

                        <tbody>
						{{-- @foreach(getcategory() as $cat) --}}
                        @foreach($category as $cat)
						<tr>
                            {{-- <td>
                              <img style="width:75px; height:75px;" src="" class="mr-2" alt="pic"><a href="items?id="> </a>
                            </td> --}}
                            <td class="align-middle"> {{$cat->name}} </td>
                            <td>
                              <img style="width:75px; height:75px;" src="{{asset('assets/uploads/category/'.$cat->image)}}" class="mr-2" alt="pic"><a href="category?id={{$cat->id}}"> </a>
                            </td>
                            <td class="align-middle"> {{$cat->description}} </td>
                            <td class="align-middle">{{$cat->status == '1' ? 'Active' : 'InActive'}}</td>
							{{-- <td class="align-middle">  </td> --}}
                            {{-- <td class="align-middle"> {{$cat->gst}} </td> --}}

                            @if(auth()->user()->is_admin=='1')
								<td class="align-middle"> <a class="btn btn-info"
                                     onclick="edititem(`{{$cat->id}}`,`{{$cat->name}}`,`{{$cat->slug}}`,`{{$cat->description}}`,`{{$cat->status}}`);">Edit</a>
                                    <a href="{{url('admin/deletecategory/'.$cat->id)}}"class="btn btn-danger"
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

function edititem(id,name,slug,description,status) {
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("slug").value = slug;
    document.getElementById("catstatus").value = status;
    document.getElementById("description").value = description;



    document.getElementById("itemsubmit").innerHTML = "Edit";
    document.getElementById("modaltittleadditem").innerHTML = "Edit Item";
    document.getElementById("categoryform").action = "\editcategory";
    $('#addcategory').modal('show');
}

function newItem() {
    document.getElementById("id").value = "";
    document.getElementById("name").value = "";
    document.getElementById("slug").value = "";
    document.getElementById("description").value = "";
    document.getElementById("itemsubmit").innerHTML = "Add";
    document.getElementById("modaltittleadditem").innerHTML = "Add Item";
    document.getElementById("categoryform").action = "\addcategory";
    $('#addcategory').modal('show');
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
