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
				<h1 class="m-0 text-dark">Editar contratista {{ $contratista->nombre }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/contratistas/{{ $contratista->id }}">
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
				<h3 class="card-title">Modifique los datos</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" action="/contratistas/{{ $contratista->id }}" method="post">
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
								<input type="text" class="form-control" name="desarrollador" placeholder="Desarrollador" value="{{ old('desarrollador', $contratista->desarrollador) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Municipio">Municipio</label>
								<input type="text" class="form-control" name="municipio" placeholder="Municipio" value="{{ old('municipio', $contratista->municipio) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Condominio">Condominio</label>
								<select class="form-control" name="condominio" required>
									<option value="" selected disabled>Selecciona condominio</option>
									@foreach ($condominios as $condominio)
                  					<option value="{{ $condominio->id }}" {{ old('condominio', $contratista['condominio_id']) == $condominio['id'] ? 'selected' : '' }}>
										{{ $condominio->nombre }}
									</option>
                  					@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Numero_contratista">N??mero de contratista</label>
								<input type="text" class="form-control" name="numero_contratista" placeholder="N??mero de contratista" value="{{ old('numero_contratista', $contratista->numero_contratista) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Empresa_contratista">Empresa de contratista</label>
								<input type="text" class="form-control" name="empresa" placeholder="Empresa de contratista" value="{{ old('empresa', $contratista->empresa) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Nombre_responsable">Nombre del contratista responsable</label>
								<input type="text" class="form-control" name="nombre" placeholder="Nombre del contratista responsable" value="{{ old('nombre', $contratista->nombre) }}">
							</div>
						</div>
            			<div class="col-sm-6">
							<div class="form-group">
								<label for="Correo">Correo</label>
								<input type="text" class="form-control" name="correo" placeholder="Correo" value="{{ old('correo', $contratista->user->email) }}">
							</div>
						</div>
            			<div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Tel??fono</label>
								<input type="text" class="form-control" name="telefono" placeholder="Tel??fono" value="{{ old('Telefono', $contratista->telefono) }}">
							</div>
						</div>
						<!--div class="col-sm-6">
							<div class="form-group">
								<label for="fecha_producto_obra" >Fecha de entrega del producto a obra</label>
								<div class="input-group date" id="fecha_producto_obra" data-target-input="nearest">
									<input type="text" name="fecha_producto_obra" class="form-control datetimepicker-input" data-target="#fecha_producto_obra" value="{{ old('fecha_producto_obra', $contratista->fecha_producto_obra) }}"/>
									<div class="input-group-append" data-target="#fecha_producto_obra" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div-->
						<!--div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_producto_a_vivienda" >Fecha de entrega del producto a entrega vivienda</label>
								<div class="input-group date" id="fecha_producto_vivienda" data-target-input="nearest">
									<input type="text" name="fecha_producto_vivienda" class="form-control datetimepicker-input" data-target="#fecha_producto_vivienda" value="{{ old('fecha_producto_vivienda', $contratista->fecha_producto_vivienda) }}"/>
									<div class="input-group-append" data-target="#fecha_producto_vivienda" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div-->
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Condominio">Coordinador de atenci??n t??cnica asignado</label>
								<select class="form-control" name="cat_id" required>
									<option value="" selected disabled>Selecciona CAT</option>
									@foreach ($cats as $cat)
                  					<option value="{{ $cat->id }}" {{ old('cat_id', $contratista['cat_id']) == $cat['id'] ? 'selected' : '' }}>
										{{ $cat->nombre }}
									</option>
                  					@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="Cat_asignado">Horario de trabajo</label>
							<div class="form-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-atc">Editar horario</button>
							</div>
						</div>
					</div> <!-- /.row -->
				</div>
				<!-- /.card-body -->
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
								<p>Selecciona los d??as y horarios de trabajo</p>

								<!-- Lunes -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_lunes" class="custom-control">Lunes</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_lunes_inicio" data-target-input="nearest">
										<input type="text" name="atc_lunes_i" class="form-control datetimepicker-input" data-target="#atc_lunes_inicio" value="{{ old('atc_lunes_i', $contratista->agenda_tc->lunes_i) }}"/>
										<div class="input-group-append" data-target="#atc_lunes_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_lunes_termino" data-target-input="nearest">
										<input type="text" name="atc_lunes_t" class="form-control datetimepicker-input" data-target="#atc_lunes_termino" value="{{ old('atc_lunes_t', $contratista->agenda_tc->lunes_t) }}"/>
										<div class="input-group-append" data-target="#atc_lunes_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Martes -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_martes" class="custom-control">Martes</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_martes_inicio" data-target-input="nearest">
										<input type="text" name="atc_martes_i" class="form-control datetimepicker-input" data-target="#atc_martes_inicio" value="{{ old('atc_martes_i', $contratista->agenda_tc->martes_i) }}"/>
										<div class="input-group-append" data-target="#atc_martes_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_martes_termino" data-target-input="nearest">
										<input type="text" name="atc_martes_t" class="form-control datetimepicker-input" data-target="#atc_martes_termino" value="{{ old('atc_martes_t', $contratista->agenda_tc->martes_t) }}"/>
										<div class="input-group-append" data-target="#atc_martes_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Miercoles -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_miercoles" class="custom-control">Miercoles</label>
									</div>
									<div class="input-group date schedule-time col" id="act_mier_inicio" data-target-input="nearest">
										<input type="text" name="atc_miercoles_i" class="form-control datetimepicker-input" data-target="#act_mier_inicio" value="{{ old('atc_miercoles_i', $contratista->agenda_tc->mier_i) }}"/>
										<div class="input-group-append" data-target="#act_mier_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_mier_termino" data-target-input="nearest">
										<input type="text" name="atc_miercoles_t" class="form-control datetimepicker-input" data-target="#atc_mier_termino" value="{{ old('atc_miercoles_t', $contratista->agenda_tc->mier_t) }}"/>
										<div class="input-group-append" data-target="#atc_mier_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Jueves -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_jueves" class="custom-control">Jueves</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_jueves_inicio" data-target-input="nearest">
										<input type="text" name="atc_jueves_i" class="form-control datetimepicker-input" data-target="#atc_jueves_inicio" value="{{ old('atc_jueves_i', $contratista->agenda_tc->jueves_i) }}"/>
										<div class="input-group-append" data-target="#atc_jueves_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_jueves_termino" data-target-input="nearest">
										<input type="text" name="atc_jueves_t" class="form-control datetimepicker-input" data-target="#atc_jueves_termino" value="{{ old('atc_jueves_t', $contratista->agenda_tc->jueves_t) }}"/>
										<div class="input-group-append" data-target="#atc_jueves_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Viernes -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_viernes" class="custom-control">Viernes</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_viernes_inicio" data-target-input="nearest">
										<input type="text" name="atc_viernes_i" class="form-control datetimepicker-input" data-target="#atc_viernes_inicio" value="{{ old('atc_viernes_i', $contratista->agenda_tc->viernes_i) }}"/>
										<div class="input-group-append" data-target="#atc_viernes_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_viernes_termino" data-target-input="nearest">
										<input type="text" name="atc_viernes_t" class="form-control datetimepicker-input" data-target="#atc_viernes_termino" value="{{ old('atc_viernes_t', $contratista->agenda_tc->viernes_t) }}"/>
										<div class="input-group-append" data-target="#atc_viernes_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Sabado -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_sabado" class="custom-control">S??bado</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_sabado_inicio" data-target-input="nearest">
										<input type="text" name="atc_sabado_i" class="form-control datetimepicker-input" data-target="#atc_sabado_inicio" value="{{ old('atc_sabado_i', $contratista->agenda_tc->sabado_i) }}"/>
										<div class="input-group-append" data-target="#atc_sabado_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_sabado_termino" data-target-input="nearest">
										<input type="text" name="atc_sabado_t" class="form-control datetimepicker-input" data-target="#atc_sabado_termino" value="{{ old('atc_sabado_t', $contratista->agenda_tc->sabado_t) }}"/>
										<div class="input-group-append" data-target="#atc_sabado_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

								<!-- Domingo -->
								<div class="row" style="margin: 5px;">
									<div class="col-2">
										<label for="atc_domingo" class="custom-control">Domingo</label>
									</div>
									<div class="input-group date schedule-time col" id="atc_domingo_inicio" data-target-input="nearest">
										<input type="text" name="atc_domingo_i" class="form-control datetimepicker-input" data-target="#atc_domingo_inicio" value="{{ old('atc_domingo_i', $contratista->agenda_tc->domingo_i) }}"/>
										<div class="input-group-append" data-target="#atc_domingo_inicio" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
									<div class="input-group date schedule-time col" id="atc_domingo_termino" data-target-input="nearest">
										<input type="text" name="atc_domingo_t" class="form-control datetimepicker-input" data-target="#atc_domingo_termino" value="{{ old('atc_domingo_t', $contratista->agenda_tc->domingo_t) }}"/>
										<div class="input-group-append" data-target="#atc_domingo_termino" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer justify-content-left">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Listo</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
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
	$('#fecha_producto_obra, #fecha_producto_vivienda').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'es',
	});

	$('.schedule-time').datetimepicker({
		format: 'HH:mm',
		useCurrent: 'hour',
		stepping: 30,
	});
});
</script>
@endpush