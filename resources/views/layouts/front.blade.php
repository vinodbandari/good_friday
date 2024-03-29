<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


     <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>




  <!-- CSS Files -->

  <link rel="stylesheet" href="{{asset('admin/css/material-dashboard.css')}}">

    <!-- Fonts -->

    <link rel="stylesheet" href="{{asset('frontend/css/boostrap.min.css')}}">

    <style>
        a{
            text-decoration: none !important;
        }
    </style>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

    <body>


          @include('layouts.inc.frontendnavbar')

          <div class="content">
            @yield('content')
          </div>



        <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
        {{-- <script src="{{asset('frontend/js/custom.js')}}"></script> --}}

        <script src="{{asset('admin/js/popper.min.js')}}"></script>

        <script src="{{asset('admin/js/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('admin/js/smooth-scrollbar.min.js')}}"></script>
        <script src="{{asset('admin/js/material-dashboard.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>



        @yield('scripts')



    </body>
</html>
