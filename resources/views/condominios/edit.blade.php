@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Editar condominio {{ $condominio->nombre }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/condominios/{{ $condominio->id }}">
							<button type="button" class="btn btn-block btn-secondary">Regresar</button>
						</a>
					</li>
				</ol>
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
				<h3 class="card-title">Modifique los datos</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" action="/condominios/{{ $condominio->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<div class="card-body">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="Nombre">Nombre del condominio</label>
								<input type="text" class="form-control" name="Nombre" placeholder="Nombre del condominio" value="{{ old('Nombre', $condominio->nombre) }}">
							</div>
						</div>
					</div> <!-- /.row -->
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('scripts')
<script src="{{ url('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
	bsCustomFileInput.init();
});
$(function () {
	$('#fecha_escrituracion').datetimepicker({
		format: 'L',
		locale: 'es'
	});

	$('#fecha_poliza').datetimepicker({
		format: 'L',
		locale: 'es'
	});

	$('#fecha_entrega').datetimepicker({
		format: 'L',
		locale: 'es'
	});
});
</script>
@endpush