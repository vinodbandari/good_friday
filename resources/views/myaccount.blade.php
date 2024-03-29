@include('layouts.header')
@include('layouts.topbar')
@include('layouts.leftbar')
 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<div id="wrapper">

	@php
    $data = getAllMemberslist();
@endphp
@if($data!=null)
<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                      @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
@if(auth()->user()->is_admin=='1')


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Manage Users</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row" id="addeditview">
                <div  class="card">
                     <div class="card-body">

                     <table width=100%>
                                <thead>
                                <tr>
                                <th>Name<span class="text-danger">*</span></th>
                                    <th>Email<span class="text-danger">*</span></th>
                                    <th>New Password<span class="text-danger">*</span></th>
                                    <th>Confirm Password<span class="text-danger">*</span></th>
                                    <th>Admin Password<span class="text-danger">*</span></th>
                                </tr>
                                </thead>

                                <tbody><tr>

                                <form id="addedit" action="/adduser" method="post" class="needs-validation">
                                @csrf
                                <input type="text" class="form-control" id="id" name="id" hidden placeholder="Finish">

                               <td>
                               <div class="form-group"> <input type="text" class="form-control" required id="name" name="name" placeholder="Name"></div></td>

                              <td> <div class="form-group"><input type="text" class="form-control" required id="email" name="email" placeholder="Code"></div>
                      </td>
                               <td><div class="form-group"><input type="password" class="form-control" required id="new_password" name="new_password" placeholder="New Password"></div>
                      </td>
                      <td><div class="form-group"><input type="password" class="form-control" id="confirm_password" required name="confirm_password" placeholder="Confirm Password"></div>
                      </td>
                      <td><div class="form-group"><input type="password" class="form-control" id="admin_password" required name="admin_password" placeholder="Admin Password"></div>
                      </td>
                      <td><div class="form-group"><button id="submit" type="submit" class="btn btn-danger waves-effect waves-light">Add</button></div></td>

</tr></form>

                                </tbody>
                                </table>

</div>
</div>
                </div>
@endif
					<div class="row">
                            <div class="col-12">
							    <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatabl1" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name </th>
													<th>Email</th>
                                                    <th>Date</th>
                                                    <th>Edit/Delete</th>

                                                </tr>
                                            </thead>

                        <tbody>
						@foreach($data as $item)
						<tr>

                            <td class="align-middle"> {{$item->id}}</a> </td>
							<td class="align-middle"> {{$item->name}} </td>
                            <td class="align-middle"> {{$item->email}} <b><span class="text-success"> {{($item->is_admin=='1') ? 'Admin' :'' }} </span> </b></td>
							<td class="align-middle"> {{date( 'd-M-Y', strtotime($item->created_at))}} </td>
                            <td class="align-middle"> <a class="btn btn-info" onclick="myFunction('{{$item->name}}','{{$item->id}}','{{$item->email}}');"><i class="fe-edit"></i></a> <a class="btn btn-danger" href="/deleteuser/id/{{$item->id}}" onclick="return confirm('Are you sure you want to Delete?');"><i class="fe-delete"></i></a></td>

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


@else
	<script>window.location = "/home";</script>
@endif
</div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <script>
function myFunction(name,id,email) {
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("submit").innerHTML = "Edit";

    document.getElementById("addedit").action = "\edituser";

    var element = document.getElementById("addeditview");
    element.scrollIntoView({behavior:"smooth"});
}

</script>


@include('layouts.footer')

<script>

$(document).ready(function() {
    $('#basic-datatabl1').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
