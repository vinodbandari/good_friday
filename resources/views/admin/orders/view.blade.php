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
                                                <li class="breadcrumb-item active">orders</li>
                                                <li class="breadcrumb-item"><a href="{{url('orders')}}" class="btn btn-warning float-end">Back</a></li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Order View</h4>


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


                                        <div class="row">
                                            <div class="col-md-6 order-details">
                                                <h4>Shipping Details</h4>
                                                <hr>
                                                {{-- <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Email</th>
                                                        <th>Contact No.</th>
                                                        <th>SHipping Address</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                     <tr>


                                                       <td>{{$orders->fname}}</td>
                                                       <td>{{$orders->lname}}</td>
                                                       <td>{{$orders->email}}</td>
                                                       <td>{{$orders->phone}}</td>
                                                       <td>{{$orders->address1}}</td>



                                                     </tr>
                                                   </tbody>
                                                </table> --}}
                                               <label for="">First Name</label>
                                               <div >{{$orders->fname}}</div>
                                               <label for="">Last Name</label>
                                               <div >{{$orders->lname}}</div>
                                               <label for="">Email</label>
                                               <div >{{$orders->email}}</div>
                                               <label for="">Contact No.</label>
                                               <div >{{$orders->phone}}</div>
                                               <label for="">Shipping Address</label>
                                               <div >
                                                  {{ $orders->address1 }},<br>
                                                  {{ $orders->address2 }},<br>
                                                  {{ $orders->city }},<br>
                                                  {{ $orders->state }},<br>
                                                  {{ $orders->country }},<br>
                                               </div>
                                               <label for="">Zip Code</label>
                                               <div >{{$orders->pincode}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>Order Details</h4>
                                                <hr>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Image</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders->orderitems as $item )
                                                        <tr>
                                                           <td>{{$item->products->name}}</td>
                                                           <td>{{$item->qty}}</td>
                                                           <td>{{$item->price}}</td>
                                                           <td>
                                                            <img src="{{asset('assets/uploads/products/'.$item->products->image)}}" width="50px" alt="">
                                                           </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <h4 class="px-2">Grand Total: <span class="float-end">{{$orders->total_price}}</span></h4>
                                                <div class="mt-5 px-2">
                                                    <label for="">Order Status</label>
                                                    <form action="{{url('update-order/'.$orders->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="order_status" class="form-select" id="">
                                                            <option {{$orders->status == '0'? 'selected':''}} value="0">Pending</option>
                                                            <option {{$orders->status == '1'? 'selected':''}} value="1">Completed</option>
                                                            <option {{$orders->status == '2'? 'selected':''}} value="2">Payment is pending</option>
                                                            <option {{$orders->status == '3'? 'selected':''}} value="3">shipped</option>
                                                            <option {{$orders->status == '4'? 'selected':''}} value="4">cancelled</option>
                                                            <option {{$orders->status == '5'? 'selected':''}} value="5">out-for-delivery</option>
                                                        </select>
                                                        {{-- <select name="order_status" class="form-select" id="">
                                                            <option value="0" {{ Request::get('status' == '0' ? 'selected' : '') }}>Pending</option>
                                                            <option value="1" {{ Request::get('status' == '1' ? 'selected' : '') }}>Completed</option>
                                                            <option value="2" {{ Request::get('status' == '2' ? 'selected' : '') }}>Payment is pending</option>
                                                            <option value="3" {{ Request::get('status' == '3' ? 'selected' : '') }}>shipped</option>
                                                        </select> --}}
                                                       <button type="submit" class="btn btn-primary mt-3 float-end">Update</button>
                                                    </form>
                                                </div>


                                            </div>
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
