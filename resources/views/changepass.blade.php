@include('layouts.header')
		
 <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="/" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset('images/icons/icon-384X384.png') }}" alt="" height="100">
                                            </span>
                                        </a>
                    
                                        <a href="/" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset('images/icons/icon-384X384.png') }}" alt="" height="100">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3"></p>
                                </div>

                                <form action="{{ route('changepass') }}" method="POST">
								@csrf
								@if(session()->has('message'))
									<div class="alert alert-success">
										{{ session()->get('message') }}
									</div>
								@endif
                                <div class="form-group mb-3">
								<label for="password">Old Password</label>
								<input id="password" type="password" class="form-control" name="old_password" required>
                               	</div>
								<div class="form-group mb-3">
								<label for="password">New Password</label>
								<input id="password" type="password" class="form-control" name="new_password" required>
                               	</div>
								<div class="form-group mb-3">
								<label for="password">Confirm Password</label>
								<input id="password" type="password" class="form-control" name="confirm_password" required>
                               	</div>
                                <div class="form-group mb-0 text-center">
                                        <button type="submit" class="btn btn-primary btn-block">
                                    Change Password
                                </button>
								</div>

                                

                                </form>

                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
@include('layouts.footer')

