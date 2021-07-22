@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
<section class="content">
	<div class="container-fluid text-center">
		<h2>Tus datos han sido enviados con exito. Un ejecutivo se pondra en contaco contigo proximamente </h2>
		<h3>Dictamen: #{{$dictamen}}</h5>
		<div class="offset-md-4 col-sm-4">
			<a href="/tickets">
				<button type="button" class="btn btn-block btn-primary">Aceptar</button>
			</a>
		</div>
	</div>
</section>
@endsection

@push('scripts')
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
@endpush