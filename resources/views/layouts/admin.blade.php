<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>




  <!-- CSS Files -->

  <link rel="stylesheet" href="{{asset('admin/css/material-dashboard.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/boostrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">

    <!-- Fonts -->



    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="g-sidenav-show  bg-gray-200">
    

    <div class="">
        @include('layouts.inc.sidebar')

        <div class="main-panel">
            @include('layouts.inc.navbar')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.inc.footer')
        </div>

    </div>

    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('admin/js/popper.min.js')}}"></script>

    <script src="{{asset('admin/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/js/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/js/material-dashboard.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    @yield('scripts')


</body>
</html>
