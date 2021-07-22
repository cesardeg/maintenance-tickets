<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Atencion a clientes</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/plugins/adminlte/css/adminlte.css') }}">
	<!-- PAGE STYLES -->
	@stack('styles')
	<!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">

	@include('general.navbar')

	@include('general.sidebar')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		@section('header')
		@show

		@yield('content')

	</div>

	@include('general.footer')
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/plugins/adminlte/js/adminlte.js') }}"></script>
<!-- PAGE SCRIPTS -->
@stack('scripts')

</body>
</html>
