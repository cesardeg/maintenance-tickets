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
				<h1 class="m-0 text-dark">Detalle de Coordinador de atención técnica</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/cat">
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
							<input type="text" class="form-control" name="Desarrollador" value="{{ $cat->desarrollador }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Municipio">Municipio</label>
							<input type="text" class="form-control" name="Municipio" value="{{ $cat->municipio }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Proyecto">Proyecto urbanístico o frente</label>
							<input type="text" class="form-control" name="Proyecto" value="{{ $cat->proyecto }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Numero_cat">Número de CAT</label>
							<input type="text" class="form-control" name="Numero_cat" value="{{ $cat->numero_cat }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Nombre_cat">Nombre completo del CAT</label>
							<input type="text" class="form-control" name="Nombre_cat" value="{{ $cat->nombre }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Correo">Correo</label>
							<input type="text" class="form-control" name="Correo" placeholder="Correo" value="{{ $cat->user->email }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Telefono">Teléfono</label>
							<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ $cat->telefono }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="Cat_asignado">Horario de disponibilidad para valoraciones</label>
						<div class="form-group">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-acat">Ver horario</button>
						</div>
					</div>
				</div> <!-- /.row -->

				<!-- Modal Agenda Disponible del CAT -->
				<div class="modal fade" id="modal-acat">
					<div class="modal-dialog modal-lg">
						<div class="modal-content bg-default">
							<div class="modal-header">
								<h4 class="modal-title">Horario de disponibilidad para valoraciones</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								@if ($cat->agenda_cat->lunes_i != null)
								<!-- Lunes -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Lunes de {{ $cat->agenda_cat->lunes_i }} a {{ $cat->agenda_cat->lunes_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->martes_i != null )
								<!-- Martes -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Martes de {{ $cat->agenda_cat->martes_i }} a {{ $cat->agenda_cat->martes_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->mier_i != null )
								<!-- Miercoles -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Miercoles de {{ $cat->agenda_cat->mier_i }} a {{ $cat->agenda_cat->mier_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->jueves_i != null )
								<!-- Jueves -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Jueves de {{ $cat->agenda_cat->jueves_i }} a {{ $cat->agenda_cat->jueves_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->viernes_i != null )
								<!-- Viernes -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Viernes de {{ $cat->agenda_cat->viernes_i }} a {{ $cat->agenda_cat->viernes_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->sabado_i != null )
								<!-- Sabado -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Sábado de {{ $cat->agenda_cat->sabado_i }} a {{ $cat->agenda_cat->sabado_t }}</p>
								</div>
								@endif

								@if (  $cat->agenda_cat->domingo_i != null )
								<!-- Domingo -->
								<div class="row justify-content-center" style="margin: 5px;">
									<p>Domingo de {{ $cat->agenda_cat->domingo_i }} a {{ $cat->agenda_cat->domingo_t }}</p>
								</div>
								@endif

								@unless($cat->has_schedule)
								<div class="row justify-content-center" style="margin: 5px;">
									<p class="text-muted">No hay horario registrado</p>
								</div>
								@endunless

							</div>
							<div class="modal-footer justify-content-left">
								<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<a href="/cat/{{ $cat->id }}/edit">
					<button type="submit" class="btn btn-primary">Editar</button>
				</a>
				<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Eliminar</button>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-danger">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="modal-title">Elimnar CAT {{ $cat->nombre }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Estás seguro que deseas eliminar al CAT {{ $cat->nombre }}?</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
					<form role="form" action="/cat/{{ $cat->id }}" method="post">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-outline-light">Eliminar</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
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
</script>
@endpush