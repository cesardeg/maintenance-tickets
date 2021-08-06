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
				<h1 class="m-0 text-dark">Editar coordinador de atención técnica</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/cat/{{ $cat->id }}">
							<button type="button" class="btn btn-block btn-secondary">Cancelar</button>
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
			<form role="form" action="/cat/{{ $cat->id }}" method="post">
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
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Desarrollador">Desarrollador</label>
								<input type="text" class="form-control" name="Desarrollador" placeholder="Desarrollador" value="{{ old('Desarrollador', $cat->desarrollador) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Municipio">Municipio</label>
								<input type="text" class="form-control" name="Municipio" placeholder="Municipio" value="{{ old('Municipio', $cat->municipio) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Proyecto">Proyecto urbanístico o frente</label>
								<input type="text" class="form-control" name="Proyecto" placeholder="Proyecto urbanístico o frente" value="{{ old('Proyecto', $cat->proyecto) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Numero_cat">Número de CAT</label>
								<input type="text" class="form-control" name="Numero_cat" placeholder="Número de CAT" value="{{ old('Numero_cat', $cat->numero_cat) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Nombre_responsable">Nombre del CAT</label>
								<input type="text" class="form-control" name="Nombre_cat" placeholder="Nombre del CAT" value="{{ old('Nombre_cat', $cat->nombre) }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Correo">Correo</label>
								<input type="text" class="form-control" name="Correo" placeholder="Correo" value="{{ old('Correo', $cat->user->email) }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Teléfono</label>
								<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ old('Telefono', $cat->telefono) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<label for="Cat_asignado">Agenda disponibilidad para valoraciones</label>
							<div class="form-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-acat">Editar agenda</button>
							</div>
						</div>
					</div> <!-- /.row -->

					<!-- Modal Agenda Disponible contratista (ATC) -->
					<div class="modal fade" id="modal-acat">
						<div class="modal-dialog modal-lg">
							<div class="modal-content bg-default">
								<div class="modal-header">
									<h4 class="modal-title">Agenda disponibilidad para valoraciones</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Selecciona los días de agenda disponible</p>

									<!-- Lunes -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_lunes" class="custom-control">Lunes</label>
										</div>
										<div class="input-group schedule-time col" id="acat_lunes_inicio" data-target-input="nearest">
											<input type="text" name="acat_lunes_i" class="form-control datetimepicker-input" data-target="#acat_lunes_inicio" value="{{ old('acat_lunes_i', $cat->agenda_cat->lunes_i) }}"/>
											<div class="input-group-append" data-target="#acat_lunes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_lunes_termino" data-target-input="nearest">
											<input type="text" name="acat_lunes_t" class="form-control datetimepicker-input" data-target="#acat_lunes_termino" value="{{ old('acat_lunes_t', $cat->agenda_cat->lunes_t) }}"/>
											<div class="input-group-append" data-target="#acat_lunes_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Martes -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_martes" class="custom-control">Martes</label>
										</div>
										<div class="input-group schedule-time col" id="acat_martes_inicio" data-target-input="nearest">
											<input type="text" name="acat_martes_i" class="form-control datetimepicker-input" data-target="#acat_martes_inicio" value="{{ old('acat_martes_i', $cat->agenda_cat->martes_i) }}"/>
											<div class="input-group-append" data-target="#acat_martes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_martes_termino" data-target-input="nearest">
											<input type="text" name="acat_martes_t" class="form-control datetimepicker-input" data-target="#acat_martes_termino" value="{{ old('acat_martes_t', $cat->agenda_cat->martes_t) }}"/>
											<div class="input-group-append" data-target="#acat_martes_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Miercoles -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_miercoles" class="custom-control">Miercoles</label>
										</div>
										<div class="input-group schedule-time col" id="acat_mier_inicio" data-target-input="nearest">
											<input type="text" name="acat_miercoles_i" class="form-control datetimepicker-input" data-target="#acat_mier_inicio" value="{{ old('acat_miercoles_i', $cat->agenda_cat->mier_i) }}"/>
											<div class="input-group-append" data-target="#acat_mier_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_mier_termino" data-target-input="nearest">
											<input type="text" name="acat_miercoles_t" class="form-control datetimepicker-input" data-target="#acat_mier_termino" value="{{ old('acat_miercoles_t', $cat->agenda_cat->mier_t) }}"/>
											<div class="input-group-append" data-target="#acat_mier_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Jueves -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_jueves" class="custom-control">Jueves</label>
										</div>
										<div class="input-group schedule-time col" id="acat_jueves_inicio" data-target-input="nearest">
											<input type="text" name="acat_jueves_i" class="form-control datetimepicker-input" data-target="#acat_jueves_inicio" value="{{ old('acat_jueves_i', $cat->agenda_cat->jueves_i) }}"/>
											<div class="input-group-append" data-target="#acat_jueves_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_jueves_termino" data-target-input="nearest">
											<input type="text" name="acat_jueves_t" class="form-control datetimepicker-input" data-target="#acat_jueves_termino" value="{{ old('acat_jueves_t', $cat->agenda_cat->jueves_t) }}"/>
											<div class="input-group-append" data-target="#acat_jueves_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Viernes -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_viernes" class="custom-control">Viernes</label>
										</div>
										<div class="input-group schedule-time col" id="acat_viernes_inicio" data-target-input="nearest">
											<input type="text" name="acat_viernes_i" class="form-control datetimepicker-input" data-target="#acat_viernes_inicio" value="{{ old('acat_viernes_i', $cat->agenda_cat->viernes_i) }}"/>
											<div class="input-group-append" data-target="#acat_viernes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_viernes_termino" data-target-input="nearest">
											<input type="text" name="acat_viernes_t" class="form-control datetimepicker-input" data-target="#acat_viernes_termino" value="{{ old('acat_viernes_t', $cat->agenda_cat->viernes_t) }}"/>
											<div class="input-group-append" data-target="#acat_viernes_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Sabado -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_sabado" class="custom-control">Sábado</label>
										</div>
										<div class="input-group schedule-time col" id="acat_sabado_inicio" data-target-input="nearest">
											<input type="text" name="acat_sabado_i" class="form-control datetimepicker-input" data-target="#acat_sabado_inicio" value="{{ old('acat_sabado_i', $cat->agenda_cat->sabado_i) }}"/>
											<div class="input-group-append" data-target="#acat_sabado_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_sabado_termino" data-target-input="nearest">
											<input type="text" name="acat_sabado_t" class="form-control datetimepicker-input" data-target="#acat_sabado_termino" value="{{ old('acat_sabado_t', $cat->agenda_cat->sabado_t) }}"/>
											<div class="input-group-append" data-target="#acat_sabado_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Domingo -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="acat_domingo" class="custom-control">Domingo</label>
										</div>
										<div class="input-group schedule-time col" id="acat_domingo_inicio" data-target-input="nearest">
											<input type="text" name="acat_domingo_i" class="form-control datetimepicker-input" data-target="#acat_domingo_inicio" value="{{ old('acat_domingo_i', $cat->agenda_cat->domingo_i) }}"/>
											<div class="input-group-append" data-target="#acat_domingo_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group schedule-time col" id="acat_domingo_termino" data-target-input="nearest">
											<input type="text" name="acat_domingo_t" class="form-control datetimepicker-input" data-target="#acat_domingo_termino" value="{{ old('acat_domingo_t', $cat->agenda_cat->domingo_t) }}"/>
											<div class="input-group-append" data-target="#acat_domingo_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

								</div>
								<div class="modal-footer justify-content-left">
									<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button> -->
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Listo</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->


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
	$('.schedule-time').datetimepicker({format: 'HH:mm', useCurrent: 'hour', stepping: 30});});
</script>
@endpush