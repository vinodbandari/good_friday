@include('layouts.header')
@include('layouts.topbar')
@include('layouts.leftbar')
 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

{{-- @if(getmemberdetail(auth()->id())->pass_changed == '1') --}}

@if(isset($data) && $data[1]!=0)
	@php $data1 = getItemDetail($data[1]);

        $cat = getCategoryDetail($data1->cat_code);
         $items = getItemsDetailsList($data1->item_code, $data1->cat_code);
    @endphp
    @endif
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
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form action="/getdata" method="post" class="needs-validation" novalidate>
@csrf
<div class="row" style="padding-bottom: 1em"></div>
                        <div class="row">

<div class ="col-lg-3">

                      {{-- <div class="form-group">
                        <input type="text" class="form-control"  id="spl" name="spl" placeholder="spl" value = "{{ (isset($data[0])) ? $data[0] : ''}}">
                      </div>
                      <input type="submit" style="visibility:hidden;position:absolute" /> --}}
                        {{-- </div>
                        <div class ="col-lg-9">
					   <div class="form-group">
                        <input type="text" class="form-control" required id="code" name="code" placeholder="Model Number" value = "{{ (isset($data[2])) ? $data[2] : ''}} " >
                      </div> --}}
</div>
</div>
                    </form>
                    @if(isset($data)&& $data[1]!=0)
                    <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">LaxmiPriya</a></li>
											<li class="breadcrumb-item active">Items</li>
                                            <li class="breadcrumb-item active">{{$cat->name}}</li>
                                            <li class="breadcrumb-item active">{{$data1->item_code}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{$cat->name." : "}}{{$data1->item_code}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

					        <div class="card">
                                        <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-6 col-xl-2">
                                        @if($data1->pic!='default.jpg')
                                        <img class = "img-fluid img-thumbnail" src="/Uploads/{{$data1->pic}}">
                                        @else
                                        <form action="/addimage" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <input class="form-control" type="file" accept="image/*" onchange="this.form.submit();" name ="image" id="inputGroupFile04">
                                        <input type="hidden" value="{{$data1->item_code}}" name="ic">
                                        <input type="hidden" value="{{$data1->cat_code}}" name="cat_code">
                                        </form>
                                        @endif
                                        </div>
                                         <div class="col-md-6 col-xl-2">
                                            Type : {{$data1->import}}
                                            </br>
                                            Finish : {{$data1->finish}}
                                        </div>
                                        </div>
                                        </div>

                                    </div>
                                    <div id="addeditview" class="card">
                                         <div classs="card-body">

                                         <h5 class="header-title" style="margin: 7px 7px 7px 7px">Add/Edit</h5>
                                            <table class="table mb-0">
                                            <thead>
                                            <tr>
                                            <th>Size</th>
                                            <th>Variant</th>
                                            <th>UoM</th>
                                            <th>MRP</th>
                                            <th>Disc</th>
                                            <th>Stock</th>

                                            <th>Add/Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <form id='addedit' action="/addvariant" method="post" class="needs-validation">
@csrf
<input type="text" class="form-control" id="id" name="id" hidden placeholder="Finish">
<input type="text" class="form-control" id="home" name="home" hidden placeholder="Home" value = "home">
<input type="text" class="form-control" readonly id="ic" name="ic" hidden value = "{{$data1->item_code}} ">
                      <input type="text" class="form-control" readonly id="cc" name="cc" hidden value = "{{$data1->cat_code}}">
                      <input type="text" class="form-control" readonly id="type" name="type" hidden value = "{{$data1->import}}">
                     <td> <input type="text" class="form-control" id="size" name="size" placeholder="Size"></td>
                     <td><input type="text" class="form-control" id="variant" name="variant" placeholder="Variant"></td>
                     <td><input type="text" class="form-control" id="uom" name="uom" placeholder="UoM"></td>
                     <td> <input type="number" class="form-control" required id="cost" name="cost" placeholder="Cost"></td>
                     <td> <input type="number" class="form-control" required id="disc" name="disc" placeholder="Discount">
                        <input type="checkbox" id="gst" name="gst" value = {{$cat->gst}}>
                        <label for="gst"> inclusive GST</label><br>
                    </td>
                     <td> <input type="number" class="form-control" required id="stock" name="stock" placeholder="Stock"></td>
					<td><button id="btnedit"type="submit" class="btn btn-danger waves-effect waves-light">Add</button></td>

                    </form>
                                                </tr>
</tbody>
                                            </table>
</div>
</div>




                                <div class="card">
                                    <div class="card-body">

                                    <div style="overflow-x:auto;">
                                        <table id="basic-datatabl1" class="table dt-responsive nowrap w-100"><thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Variant</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>UoM</th>
                                                    <th>Cost</th>
                                                    @if(auth()->user()->is_admin=='1')
                                                    <th>Edit/Delete</th>
                                                    @endif
                                                    <th>Cart</th>
                                                </tr>
                                            </thead>

                        <tbody>
						@foreach($items as $item)
						<tr>
                            <td class="align-middle"> {{$item->size}} </td>
							<td class="align-middle"> {{$item->variant}} </td>

                            <td class="align-middle" > {{getprice(getsellprice($item->mrp,$item->cost,$data1->import,$item->item_code,$item->cat_code),$data[0])}} </td>
                            <td class="align-middle"> {{$item->stock}} </td>
                            <td class="align-middle"> {{$item->uom}} </td>

							<td class="align-middle"> {{$item->sell_code}} </td>
                           @if(auth()->user()->is_admin=='1')
                            <td class="align-middle"> <a class="btn btn-info" onclick="myFunction('{{($item->id)}}','{{($item->size) ? $item->size : ''}}','{{($item->variant) ? $item->variant : ''}}','{{$item->uom}}',{{$item->mrp}},{{$item->disc}},{{$item->gst}},{{$item->stock}});">Edit</a> <a class="btn btn-danger" onclick="deletevariant('{{$item->id}}');">Delete</a></td>
                            @endif
                            <td class="align-middle"> <a data-toggle="modal" data-target="#addcart" class="btn btn-info" onclick="modal('{{($item->size) ? $item->size : ''}}','{{($item->variant) ? $item->variant : ''}}','{{$item->id}}','{{getprice(getsellprice($item->cost, $item->cost,$data1->import,$item->item_code,$item->cat_code),$data[0])}}');">Add to Cart </a> </td>


                        </tr>
						@endforeach
                        </tbody>
                        <div class="modal fade" id="addcart" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabelCart">Add to Cart </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                        <form action = "/addcart"  method="post" class="needs-validation">
                            @csrf
                        <input type="text" class="form-control" id="cart_id" name="cart_id" hidden>
                        <input type="text" class="form-control" id="cart_spl" name="cart_spl" hidden>
                        <input type="text" class="form-control" id="cart_price" name="cart_price" hidden>
                        <label for="exampleInputPassword4">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="cart_qty" name="cart_qty" required placeholder="Quantity">
                        <label for="exampleInputPassword4">Finish <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cart_finish" name="cart_finish" required placeholder="Finish">
                        <label for="exampleInputPassword4">Discount</label>
                        <input type="number" class="form-control" id="cart_disc" name="cart_disc"  placeholder="Discount">
                        <label for="exampleInputPassword4">Remarks</label>
                        <input type="text" class="form-control" id="cart_remark" name="cart_remark" placeholder="Remarks">
                        <button id="btneditcart" type="submit" class="btn btn-danger waves-effect waves-light">Add</button>
</form>
                      </div>
                      </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->


</tbody>
										</table></div>

                                    </div> <!-- end card body-->
                                </div>
                                @if(auth()->user()->is_admin=='1')
                                <div id="addeditviewdealer" class="card">
                                         <div classs="card-body">

                                         <h4 class="header-title" style="margin: 7px 7px 7px 7px">Add/Edit Dealer</h4>
                                         <div style="overflow-x:auto;">
                                         <table class="table mb-0">
                                            <thead>
                                            <tr>
                                            <th>Model</th>
                                            <th>Company<a data-toggle="modal" data-target="#addcompany" > <span class="text-info">Add new Company</span></a></th>
                                            <div class="modal fade" id="addcompany" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabel">Add New Company</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                        <label for="exampleInputPassword4">Company Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="newcompany" name="newcompany" placeholder="Company">

                      </div>
                      <a class="btn btn-info" onClick="addnewcompany();" class="close" data-dismiss="modal" aria-hidden="true" >Add</a>
														</div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                            <th>Dealer<a data-toggle="modal" data-target="#adddealer" > <span class="text-info">Add new Dealer</span></a></th>
                                            <div class="modal fade" id="adddealer" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabel">Add New Dealer</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                        <label for="exampleInputPassword4">Dealer Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="newdealer" name="newdealer" placeholder="Dealer">

                      </div>
                      <a class="btn btn-info" onClick="addnew();" class="close" data-dismiss="modal" aria-hidden="true" >Add</a>
														</div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                            <th>Master</th>
                                            @if(auth()->user()->is_admin=='1')
                                           <th>Add/Edit</th>
                                           @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <form id='addeditdealer' action="/adddealer" method="post" class="needs-validation">
@csrf
<input type="text" class="form-control" id="idd" name="idd" hidden placeholder="Finish">
<input type="text" class="form-control" id="home" name="home" hidden placeholder="Home" value = "home">
<input type="text" class="form-control" readonly id="ic" name="ic" hidden value = "{{$data1->item_code}} ">
                      <input type="text" class="form-control" readonly id="cc" name="cc" hidden value = "{{$data1->cat_code}}">
                      <input type="text" class="form-control" readonly id="type" name="type" hidden value = "{{$data1->import}}">
                     <td> <input type="text" class="form-control" id="model" name="model" placeholder="Model"></td>
                     <td> <select class="form-control" required id="company" name="company">
                        @foreach(getcompanylist() as $dealer)

                         <option value="{{$dealer->company}}">{{$dealer->company}}</option>
                        @endforeach

                       </select></td>
                       <td>
                        <select class="form-control" required id="dealers" name="dealers">
                       @foreach(getdealerlist() as $dealer)

                        <option value="{{$dealer->dealer}}">{{$dealer->dealer}}</option>
                       @endforeach

                      </select></td>
                     <td> <input type="checkbox" id="master" name="master"></td>
					<td><button id="btneditdealer" type="submit" class="btn btn-danger waves-effect waves-light">Add</button></td>

                    </form>
                                                </tr>
</tbody>
                                            </table>
</div>
</div>
@endif

                                 <div class="card">
                                    <div class="card-body">

                                    <div style="overflow-x:auto;">

                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Model</th>
                                                    <th>Company</th>
													<th>Dealer</th>
                                                    <th>Master</th>
                                                    @if(auth()->user()->is_admin=='1')
                                                    <th>Edit/Delete</th>
                                                    @endif

                                                </tr>
                                            </thead>

                        <tbody>
						@foreach(getdealers($data1->cat_code,$data1->item_code) as $dealer)
						<tr>
                            <td class="align-middle"> {{$dealer->model}} </td>
							<td class="align-middle"> {{$dealer->company}} </td>
                            <td class="align-middle"> {{$dealer->dealer}} </td>
                            <td class="align-middle"><span class="text-success"> {{($dealer->master=='1') ? 'Master' :'' }} </span></td>
                            @if(auth()->user()->is_admin=='1')
                            <td class="align-middle"> <a class="btn btn-info" onclick="myFunctionDealer('{{$dealer->id}}','{{($dealer->model) ? $dealer->model : ''}}','{{($dealer->company) ? $dealer->company : ''}}','{{$dealer->dealer}}','{{$dealer->master}}');">Edit</a> <a onclick="deletedealer('{{$dealer->id}}');" class="btn btn-danger" >Delete</a></td>
                            @endif

                        </tr>
						@endforeach
                        </tbody>




										</table>
                                        <div>
                                    </div> <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->
                    @else
                    {{-- <h2> No record Found</h2> --}}

                    <h1>Dashboard</h1>
                    <div>
                        @if(session('error'))
                            <div class="alert alert-success mb-3" id="alert">
                            {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card" id="tooltip-container">
                                <div class="card-body">
                                    <a href="{{url('admin/category')}}">
                                    <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                    <h4 class="mt-0 font-16">Categories</h4>
                                    <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$categories}}</span></h2>
                                    {{-- <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"></span></h2> --}}
                                    <p class="text-muted mb-0"> <span class="float-end"><i class=""></i></span></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card" id="tooltip-container1">
                                <div class="card-body">
                                    <a href="{{url('admin/product')}}">
                                    <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                    <h4 class="mt-0 font-16">Products</h4>
                                    <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$products}}</span></h2>
                                    {{-- <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"></span></h2> --}}
                                    <p class="text-muted mb-0"> <span class="float-end"><i class=""></i> </span></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card" id="tooltip-container2">
                                <div class="card-body">
                                    <a href="{{url('admin/users')}}">
                                    <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                    <h4 class="mt-0 font-16">Users</h4>
                                    <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$users}}</span></h2>
                                    {{-- <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"></span></h2> --}}
                                    <p class="text-muted mb-0"> <span class="float-end"><i class=""></i> </span></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card" id="tooltip-container3">
                                <div class="card-body">
                                    <a href="{{url('orders')}}">
                                    <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                                    <h4 class="mt-0 font-16">Orders</h4>
                                    <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{$orders}}</span></h2>
                                    {{-- <h2 class="text-primary my-3 text-center"><span data-plugin="counterup"></span></h2> --}}
                                    <p class="text-muted mb-0"> <span class="float-end"><i class=""></i> </span></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                    </div> <!-- container -->




                </div> <!-- content -->

                                <!-- Footer Start -->
				<!-- end Footer -->

            </div>
			</div>
{{-- @else --}}
{{-- <script>window.location = "/changepassword";</script> --}}
{{-- @endif --}}


<script>
function myFunction(id,size,variant,uom,mrp,disc,gst,stock) {
    document.getElementById("id").value = id;

    document.getElementById("size").value = size;
    document.getElementById("variant").value = variant;
    document.getElementById("uom").value = uom;

    document.getElementById("cost").value = mrp;
    document.getElementById("disc").value = disc;
	if(gst=='1')
{
	document.getElementById("gst").checked = true;
}
else
{
	document.getElementById("gst").checked = false;
}
    document.getElementById("stock").value = stock;
    document.getElementById("btnedit").innerHTML = "Edit";
    document.getElementById("addedit").action = "\editvariant";
    var element = document.getElementById("addeditview");
    element.scrollIntoView({behavior:"smooth"});

}

function addnew()
{
   var newdealer= document.getElementById("newdealer").value;
   var dealers = document.getElementById("dealers");
   var option = document.createElement("OPTION");
   option.value = newdealer;
   option.innerHTML = newdealer;
   option.selected = true;
   dealers.appendChild(option);
}

function addnewcompany()
{
   var newdealer= document.getElementById("newcompany").value;
   var dealers = document.getElementById("company");
   var option = document.createElement("OPTION");
   option.value = newdealer;
   option.innerHTML = newdealer;
   option.selected = true;
   dealers.appendChild(option);
}

function deletedealer(id)
{
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            url: '/deletedealer/id/'+id,
            type: "get",
            data: {
                // data stuff here
            },
            success: function () {
                window.location.reload();
            }
        });
    }
}

function deletevariant(id)
{
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            url: '/deletevariant/id/'+id,
            type: "get",
            data: {
                // data stuff here
            },
            success: function () {
                window.location.reload();
            }
        });
    }
}

function myFunctionDealer(id,model,company,dealer,master) {
    document.getElementById("idd").value = id;

    document.getElementById("model").value = model;
    document.getElementById("company").value = company;
    document.getElementById("dealers").value = dealer;
    if(master=='1')
    {
        document.getElementById("master").checked = true;
    }
    else{
        document.getElementById("master").checked = false;
    }
    document.getElementById("btneditdealer").innerHTML = "Edit";
    document.getElementById("addeditdealer").action = "\editdealer";
    var element = document.getElementById("addeditviewdealer");
    element.scrollIntoView({behavior:"smooth"});

}

function modal(size,variant,id,price)
{
if(variant=="")
{
    document.getElementById("myCenterModalLabelCart").innerHTML = document.getElementById("code").value + " | "+ size + " | " + price;
}
else
{
	document.getElementById("myCenterModalLabelCart").innerHTML = document.getElementById("code").value + " | "+ size +" |  "+variant +" | " + price;

}
	document.getElementById("cart_qty").focus();
    document.getElementById("cart_id").value = id;
    document.getElementById("cart_price").value = price;
    document.getElementById("cart_spl").value = document.getElementById("spl").value;
}
</script>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->




@include('layouts.footer')
<script>
$(document).ready(function() {
    $('basic-datatabl1').DataTable( {
        "order": [[ 2, "desc" ]],
    } );
} );
$('#addcart').on('shown.bs.modal', function() {
  $('#cart_qty').focus();
});

</script>


<script type="text/javascript">
  $("document").ready(function()
  {
    setTimeout(function()
    {
        $('#alert').remove();

    },3000);
  });
</script>

@php
if(session()->has('pdfid'))
{
echo "<script> location.href='/generate-pdf/".session()->get('pdfid')."';</script>";
}
@endphp
