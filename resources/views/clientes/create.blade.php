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
				<h1 class="m-0 text-dark">Registrar nuevo cliente</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/clientes">
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
				<h3 class="card-title">Ingresa los datos</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" action="/clientes" method="post">
			{{ csrf_field() }}
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
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Desarrollador">Desarrollador</label>
								<input type="text" class="form-control" name="Desarrollador" placeholder="Desarrollador" value="{{ old('Desarrollador') }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Municipio">Municipio</label>
								<input type="text" class="form-control" name="Municipio" placeholder="Municipio" value="{{ old('Municipio') }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Condominio">Condominio</label>
								<select class="form-control" name="Condominio">
									@foreach ($condominios as $condominio)
                  <option value="{{ $condominio->id }}" {{ old('Condominio') == $condominio->id ? 'selected' : '' }} >{{ $condominio->nombre }}</option>
                  @endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Numero_cliente">Número de cliente</label>
								<input type="text" class="form-control" name="Numero_cliente" placeholder="Número de cliente" value="{{ old('Numero_cliente') }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Nombre_completo">Nombre completo</label>
								<input type="text" class="form-control" name="Nombre_completo" placeholder="Nombre completo" value="{{ old('Nombre_completo') }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Coopropietario">Coopropietario</label>
								<input type="text" class="form-control" name="Coopropietario" placeholder="Coopropietario" value="{{ old('Coopropietario') }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Correo">Correo</label>
								<input type="text" class="form-control" name="Correo" placeholder="Correo" value="{{ old('Correo') }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Teléfono</label>
								<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ old('Telefono') }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_escrituracion" >Fecha de escrituración</label>
								<div class="input-group date" id="fecha_escrituracion" data-target-input="nearest">
									<input type="text" name="Fecha_escrituracion" class="form-control datetimepicker-input" data-target="#fecha_escrituracion" value="{{ old('Fecha_escrituracion') }}"/>
									<div class="input-group-append" data-target="#fecha_escrituracion" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_poliza" >Fecha de póliza de garantía</label>
								<div class="input-group date" id="fecha_poliza" data-target-input="nearest">
									<input type="text" name="Fecha_poliza" class="form-control datetimepicker-input" data-target="#fecha_poliza" value="{{ old('Fecha_poliza') }}"/>
									<div class="input-group-append" data-target="#fecha_poliza" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_entrega" >Fecha de entrega</label>
								<div class="input-group date" id="fecha_entrega" data-target-input="nearest">
									<input type="text" name="Fecha_entrega" class="form-control datetimepicker-input" data-target="#fecha_entrega" value="{{ old('Fecha_entrega') }}"/>
									<div class="input-group-append" data-target="#fecha_entrega" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="Comentarios">Comentarios de la entrega</label>
								<textarea class="form-control" rows="3" name="Comentarios" placeholder="Comentarios de la entrega">{{ old('Comentarios') }}</textarea>
							</div>
						</div>
					</div> <!-- /.row -->
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Registrar</button>
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