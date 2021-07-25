@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/select2/css/select2.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Detalle de ticket</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Información general</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Desarrollador">Folio</label>
							<p>{{ $ticket->id }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Desarrollador">Fecha de alta</label>
							<p>{{ $ticket->created_at }}</p>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>
@endsection