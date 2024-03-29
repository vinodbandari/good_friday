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
                                                <li class="breadcrumb-item active">Contacts</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Contacts</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->


                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Comment</th>
                                                    <th>Message Send On</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach($contacts as $items)
                                                <tr>

                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $items->firstname }}</td>
                                                    <td>{{ $items->lastname }}</td>
                                                    <td>{{ $items->email }}</td>
                                                    <td>{{ $items->number }}</td>
                                                    <td>{{ $items->message }}</td>
                                                    <td>{{ date('d-M-Y H:i:s', strtotime($items->created_at)) }}</td>

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
