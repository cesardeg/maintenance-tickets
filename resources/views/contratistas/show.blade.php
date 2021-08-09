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
				<h1 class="m-0 text-dark">Detalle de Contratista</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/contratistas">
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
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Datos generales</h3>
			</div>
			<!-- /.card-header -->
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
							<input type="text" class="form-control" name="Desarrollador" value="{{ $contratista->desarrollador }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Municipio">Municipio</label>
							<input type="text" class="form-control" name="Municipio" value="{{ $contratista->municipio }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Proyecto">Proyecto urbanístico o frente</label>
							<input type="text" class="form-control" name="Proyecto" value="{{ $contratista->proyecto }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Numero_contratista">Número de contratista</label>
							<input type="text" class="form-control" name="Numero_contratista" value="{{ $contratista->numero_contratista }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Empresa_contratista">Empresa de contratista</label>
							<input type="text" class="form-control" name="Empresa_contratista" value="{{ $contratista->empresa }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Nombre_responsable">Nombre del contratista responsable</label>
							<input type="text" class="form-control" name="Nombre_responsable" value="{{ $contratista->nombre }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Correo">Correo</label>
							<input type="text" class="form-control" name="Correo" placeholder="Correo" value="{{ $contratista->user->email }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Telefono">Teléfono</label>
							<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ $contratista->telefono }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="fecha_producto_obra" >Fecha de entrega del producto a obra</label>
							<input type="text" class="form-control" name="fecha_producto_obra" value="{{ $contratista->fecha_producto_obra }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Fecha_producto_a_vivienda" >Fecha de entrega del producto a entrega vivienda</label>
							<input type="text" class="form-control" name="Fecha_producto_a_vivienda" value="{{ $contratista->fecha_producto_vivienda }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Cat_asignado">Coordinador de atención técnica asignado</label>
							<input type="text" class="form-control" name="Cat_asignado" value="{{ $contratista->coordinador }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="Cat_asignado">Horario de trabajo</label>
						<div class="form-group">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-atc">Ver horario</button>
						</div>
					</div>
				</div> <!-- /.row -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<a href="/contratistas/{{ $contratista->id }}/edit">
					<button type="submit" class="btn btn-primary">Editar</button>
				</a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Eliminar</button>
			</div>
		</div>
	</div>
	
</section>

<!-- Modal Agenda Disponible contratista (ATC) -->
<div class="modal fade" id="modal-atc">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-default">
			<div class="modal-header">
				<h4 class="modal-title">Horario de trabajo</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				@if ($contratista->agenda_tc->lunes_i != null)
				<!-- Lunes -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Lunes de {{ $contratista->agenda_tc->lunes_i }} a {{ $contratista->agenda_tc->lunes_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->martes_i != null)
				<!-- Martes -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Martes de {{ $contratista->agenda_tc->martes_i }} a {{ $contratista->agenda_tc->martes_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->mier_i != null)
				<!-- Miercoles -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Miercoles de {{ $contratista->agenda_tc->mier_i }} a {{ $contratista->agenda_tc->mier_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->jueves_i != null)
				<!-- Jueves -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Jueves de {{ $contratista->agenda_tc->jueves_i }} a {{ $contratista->agenda_tc->jueves_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->viernes_i != null)
				<!-- Viernes -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Viernes de {{ $contratista->agenda_tc->viernes_i }} a {{ $contratista->agenda_tc->viernes_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->sabado_i != null)
				<!-- Sabado -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Sábado de {{ $contratista->agenda_tc->sabado_i }} a {{ $contratista->agenda_tc->sabado_t }}</p>
				</div>
				@endif

				@if ($contratista->agenda_tc->domingo_i != null)
				<!-- Domingo -->
				<div class="row justify-content-center" style="margin: 5px;">
					<p>Domingo de {{ $contratista->agenda_tc->domingo_i }} a {{ $contratista->agenda_tc->domingo_t }}</p>
				</div>
				@endif

				@unless($contratista->has_schedule)
				<div class="row justify-content-center" style="margin: 5px;">
					<p class="text-muted">No hay horario registrado</p>
				</div>
				@endunless

			</div>
			<div class="modal-footer justify-content-left">
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
				<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Asignar</button> -->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
</script>
@endpush