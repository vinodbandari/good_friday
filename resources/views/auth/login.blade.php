
@include('layouts.laxmi.header')

<body>

    <!-- Start preloader -->
       @include('layouts.laxmi.preloader')
    <!-- End preloader -->

     <!-- Start header area -->
     <header class="header__section">
        @include('layouts.laxmi.top_navbar')

        @include('layouts.laxmi.main_header')

        <!-- Start Offcanvas header menu -->
       @include('layouts.laxmi.offcanvas_header')
        <!-- End Offcanvas header menu -->

        <!-- Start Offcanvas sticky toolbar -->
       @include('layouts.laxmi.offcanvas_sticky')
        <!-- End Offcanvas sticky toolbar -->

        {{-- M I N I   C A R T --}}
        <!-- Start offCanvas minicart -->
       {{-- @include('layouts.laxmi.mini_cart') --}}
        <!-- End offCanvas minicart -->

        <!-- Start serch box area -->
       @include('layouts.laxmi.search_box')
        <!-- End serch box area -->

    </header>
    <!-- End header area -->

    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="/">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Account Page</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                {{-- <form action="{{ route('login') }}" method="POST">
                    @csrf --}}
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">

                            {{-- L O G I N   F O R M --}}
                            <div class="col">
                                <form action="{{ route('login') }}"  method="POST">
                                    @csrf
                                    <div class="account__login">
                                        <div class="account__login--header mb-25">
                                            <h2 class="account__login--header__title mb-15">Login</h2>
                                            <p class="account__login--header__desc">Login if you are a returning customer.</p>
                                        </div>
                                        <div class="account__login--inner">
                                            <label>
                                                <input id="email" class="account__login--input" placeholder="Email Addres" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            </label>
                                            <label>
                                                <input id="password" class="account__login--input" placeholder="Password" type="password" name="password" required autocomplete="current-password">
                                            </label>
                                            <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                                <div class="account__login--remember position__relative">
                                                    <input class="checkout__checkbox--input" id="check1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkout__checkbox--checkmark"></span>
                                                    <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                        Remember me</label>
                                                </div>
                                                <button class="account__login--forgot"  type="submit">Forgot Your Password?</button>
                                            </div>                 <button class="account__login--btn primary__btn" type="submit">Login</button>

                                            {{-- <div class="account__login--divide">
                                                <span class="account__login--divide__text">OR</span>
                                            </div>
                                            <div class="account__social d-flex justify-content-center mb-15">
                                                <a class="account__social--link facebook" target="_blank" href="https://www.facebook.com">Facebook</a>
                                                <a class="account__social--link google" target="_blank" href="https://www.google.com">Google</a>
                                                <a class="account__social--link twitter" target="_blank" href="https://twitter.com">Twitter</a>
                                            </div> --}}
                                            <p class="account__login--signup__text">Don,t Have an Account? <button type="submit">Sign up now</button></p>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            {{-- R E G I S T E R    F O R M --}}
                            <div class="col">
                                <form action="{{ route('register') }}" id="loginform" method="POST">
                                    @csrf
                                <div class="account__login register">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title mb-15">Create an Account</h2>
                                        <p class="account__login--header__desc">Register here if you are a new customer</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <label>
                                            <input id="name" class="account__login--input" placeholder="Username" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </label>
                                        <label>
                                            <input id="email" class="account__login--input" placeholder="Email Addres" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        </label>
                                        <label>
                                            <input id="password" class="account__login--input" placeholder="Password" type="password" name="password" required autocomplete="new-password">
                                        </label>
                                        <label>
                                            <input id="password-confirm" class="account__login--input" placeholder="Confirm Password" type="password" name="password_confirmation" required autocomplete="new-password">
                                        </label>
                                        <button id="submit_btn" class="account__login--btn primary__btn mb-10" type="submit" onclick="return validateterms()">Submit & Register</button>
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" id="checkterms" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label" for="check2">
                                                I have read and agree to the <a style="color: red" href="/login/terms_conditions">terms & conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End login section  -->

        <!-- Start feature section -->
                @include('layouts.laxmi.feature_icons')
        <!-- End feature section -->

    </main>

    <!-- Start footer section -->
    <footer class="footer__section footer__bg">
           @include('layouts.laxmi.footer')
    </footer>
    <!-- End footer section -->


     <!-- Scroll top bar -->
   <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>

   <!-- All Script JS Plugins here  -->
   <script src="{{ asset('bcute/js/vendor/popper.js') }}" defer="defer"></script>
   <script src="{{ asset('bcute/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
   <script src="{{ asset('bcute/js/plugins/swiper-bundle.min.js') }}"></script>
   <script src="{{ asset('bcute/js/plugins/glightbox.min.js') }}"></script>

  <!-- Customscript js -->
  <script src="{{ asset('bcute/js/script.js') }}"></script>
  <script>
    // function ter()
    // {
    //     if(document.getElementById('loginterms').checked)
    //             {
    //                 alert('hi');
    //                 window.location.href="/checkout";
    //                 document.getElementById("register_form").submit();
    //             }
    //             else{
    //                 alert('bye');
    //                   swal(response.status)
    //                 alert('Read And Agree the terms and conditions');
    //             }
    // }

    // function terms()
    // {

    //     var longterms = document.getElementById("longterms");
    //     var btn = document.getElementById("btn");

    //     if(longterms.checked)
    //     {

    //         btn.removeAttribute("disabled");
    //         document.getElementById("register_form").submit();

    //     }
    //     else
    //     {
    //         btn.attr('name', 'disabled') ;
    //     }
    // }
  </script>

</body>
</html>
