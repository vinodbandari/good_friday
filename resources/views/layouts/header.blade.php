<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
        <title>LaxmiPriya Stock Keeping</title>
		<meta name="viewport" content="width=device-width, user-scalable=no,  initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<meta name="csrf-token" content="{{csrf_token()}}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo-sm.png')}}">

		<!-- App css -->
		<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />

		<link href="{{ asset('css/bootstrap-material.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('css/app-material.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="{{ asset('css/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />

		<!-- third party css -->
        <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

		<!-- third party css end -->

		<!-- icons -->
		<link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<style>
.text-muted { color: #7b1a10!important;
			font-size: large;
}
</style>
</head>

