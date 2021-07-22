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
		<div class="card card-primary">
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
								<input type="text" class="form-control" name="Desarrollador" placeholder="Desarrollador" value="{{ old('Desarrollador', $contratista->desarrollador) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Municipio">Municipio</label>
								<input type="text" class="form-control" name="Municipio" placeholder="Municipio" value="{{ old('Municipio', $contratista->municipio) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Proyecto">Proyecto urbanístico o frente</label>
								<input type="text" class="form-control" name="Proyecto" placeholder="Proyecto urbanístico o frente" value="{{ old('Proyecto', $contratista->proyecto) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Numero_contratista">Número de contratista</label>
								<input type="text" class="form-control" name="Numero_contratista" placeholder="Número de contratista" value="{{ old('Numero_contratista', $contratista->numero_contratista) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Empresa_contratista">Empresa de contratista</label>
								<input type="text" class="form-control" name="Empresa_contratista" placeholder="Empresa de contratista" value="{{ old('Empresa_contratista', $contratista->empresa) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Nombre_responsable">Nombre del contratista responsable</label>
								<input type="text" class="form-control" name="Nombre_responsable" placeholder="Nombre del contratista responsable" value="{{ old('Nombre_responsable', $contratista->nombre) }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Correo">Correo</label>
								<input type="text" class="form-control" name="Correo" placeholder="Correo" value="{{ old('Correo', $contratista->user->email) }}">
							</div>
						</div>
            <div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Teléfono</label>
								<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ old('Telefono', $contratista->telefono) }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_producto_a_obra" >Fecha de entrega del producto a obra</label>
								<div class="input-group date" id="fecha_producto_a_obra" data-target-input="nearest">
									<input type="text" name="Fecha_producto_a_obra" class="form-control datetimepicker-input" data-target="#fecha_producto_a_obra" value="{{ old('Fecha_producto_a_obra', $contratista->fecha_producto_obra) }}"/>
									<div class="input-group-append" data-target="#fecha_producto_a_obra" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Fecha_producto_a_vivienda" >Fecha de entrega del producto a entrega vivienda</label>
								<div class="input-group date" id="fecha_producto_a_vivienda" data-target-input="nearest">
									<input type="text" name="Fecha_producto_a_vivienda" class="form-control datetimepicker-input" data-target="#fecha_producto_a_vivienda" value="{{ old('Fecha_producto_a_vivienda', $contratista->fecha_producto_vivienda) }}"/>
									<div class="input-group-append" data-target="#fecha_producto_a_vivienda" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Cat_asignado">Coordinador de atención técnica asignado</label>
								<input type="text" class="form-control" name="Cat_asignado" placeholder="Coordinador de atención técnica asignado" value="{{ old('Cat_asignado', $contratista->coordinador) }}">
							</div>
						</div>
						<div class="col-sm-6">
						</div>
						<div class="col-sm-6">
							<label for="Cat_asignado">Agenda disponible de trabajo del contratista</label>
							<div class="form-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-atc">Asignar</button>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="Cat_asignado">Agenda disponible de coordinador de atención técnica asignado</label>
							<div class="form-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-acat">Asignar</button>
							</div>
						</div>
					</div> <!-- /.row -->

					<!-- Modal Agenda Disponible contratista (ATC) -->
					<div class="modal fade" id="modal-atc">
						<div class="modal-dialog modal-lg">
							<div class="modal-content bg-default">
								<div class="modal-header">
									<h4 class="modal-title">Asignar agenda disponible de trabajo del contratista</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Selecciona los días de agenda disponible</p>

									<!-- Lunes -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="atc_lunes" class="custom-control">Lunes</label>
										</div>
										<div class="input-group date col" id="atc_lunes_inicio" data-target-input="nearest">
											<input type="text" name="atc_lunes_i" class="form-control datetimepicker-input" data-target="#atc_lunes_inicio" value="{{ old('atc_lunes_i', $contratista->agenda_tc->lunes_i) }}"/>
											<div class="input-group-append" data-target="#atc_lunes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_lunes_termino" data-target-input="nearest">
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
										<div class="input-group date col" id="atc_martes_inicio" data-target-input="nearest">
											<input type="text" name="atc_martes_i" class="form-control datetimepicker-input" data-target="#atc_martes_inicio" value="{{ old('atc_martes_i', $contratista->agenda_tc->martes_i) }}"/>
											<div class="input-group-append" data-target="#atc_martes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_martes_termino" data-target-input="nearest">
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
										<div class="input-group date col" id="act_mier_inicio" data-target-input="nearest">
											<input type="text" name="atc_miercoles_i" class="form-control datetimepicker-input" data-target="#act_mier_inicio" value="{{ old('atc_miercoles_i', $contratista->agenda_tc->mier_i) }}"/>
											<div class="input-group-append" data-target="#act_mier_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_mier_termino" data-target-input="nearest">
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
										<div class="input-group date col" id="atc_jueves_inicio" data-target-input="nearest">
											<input type="text" name="atc_jueves_i" class="form-control datetimepicker-input" data-target="#atc_jueves_inicio" value="{{ old('atc_jueves_i', $contratista->agenda_tc->jueves_i) }}"/>
											<div class="input-group-append" data-target="#atc_jueves_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_jueves_termino" data-target-input="nearest">
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
										<div class="input-group date col" id="atc_viernes_inicio" data-target-input="nearest">
											<input type="text" name="atc_viernes_i" class="form-control datetimepicker-input" data-target="#atc_viernes_inicio" value="{{ old('atc_viernes_i', $contratista->agenda_tc->viernes_i) }}"/>
											<div class="input-group-append" data-target="#atc_viernes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_viernes_termino" data-target-input="nearest">
											<input type="text" name="atc_viernes_t" class="form-control datetimepicker-input" data-target="#atc_viernes_termino" value="{{ old('atc_viernes_t', $contratista->agenda_tc->viernes_t) }}"/>
											<div class="input-group-append" data-target="#atc_viernes_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

									<!-- Sabado -->
									<div class="row" style="margin: 5px;">
										<div class="col-2">
											<label for="atc_sabado" class="custom-control">Sábado</label>
										</div>
										<div class="input-group date col" id="atc_sabado_inicio" data-target-input="nearest">
											<input type="text" name="atc_sabado_i" class="form-control datetimepicker-input" data-target="#atc_sabado_inicio" value="{{ old('atc_sabado_i', $contratista->agenda_tc->sabado_i) }}"/>
											<div class="input-group-append" data-target="#atc_sabado_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_sabado_termino" data-target-input="nearest">
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
										<div class="input-group date col" id="atc_domingo_inicio" data-target-input="nearest">
											<input type="text" name="atc_domingo_i" class="form-control datetimepicker-input" data-target="#atc_domingo_inicio" value="{{ old('atc_domingo_i', $contratista->agenda_tc->domingo_i) }}"/>
											<div class="input-group-append" data-target="#atc_domingo_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="atc_domingo_termino" data-target-input="nearest">
											<input type="text" name="atc_domingo_t" class="form-control datetimepicker-input" data-target="#atc_domingo_termino" value="{{ old('atc_domingo_t', $contratista->agenda_tc->domingo_t) }}"/>
											<div class="input-group-append" data-target="#atc_domingo_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

								</div>
								<div class="modal-footer justify-content-left">
									<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button> -->
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Asignar</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->

					<!-- Modal Agenda Disponible contratista (ATC) -->
					<div class="modal fade" id="modal-acat">
						<div class="modal-dialog modal-lg">
							<div class="modal-content bg-default">
								<div class="modal-header">
									<h4 class="modal-title">Asignar agenda disponible de coordinador de atención técnica asignado</h4>
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
										<div class="input-group date col" id="acat_lunes_inicio" data-target-input="nearest">
											<input type="text" name="acat_lunes_i" class="form-control datetimepicker-input" data-target="#acat_lunes_inicio" value="{{ old('acat_lunes_i', $contratista->agenda_cat->lunes_i) }}"/>
											<div class="input-group-append" data-target="#acat_lunes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_lunes_termino" data-target-input="nearest">
											<input type="text" name="acat_lunes_t" class="form-control datetimepicker-input" data-target="#acat_lunes_termino" value="{{ old('acat_lunes_t', $contratista->agenda_cat->lunes_t) }}"/>
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
										<div class="input-group date col" id="acat_martes_inicio" data-target-input="nearest">
											<input type="text" name="acat_martes_i" class="form-control datetimepicker-input" data-target="#acat_martes_inicio" value="{{ old('acat_martes_i', $contratista->agenda_cat->martes_i) }}"/>
											<div class="input-group-append" data-target="#acat_martes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_martes_termino" data-target-input="nearest">
											<input type="text" name="acat_martes_t" class="form-control datetimepicker-input" data-target="#acat_martes_termino" value="{{ old('acat_martes_t', $contratista->agenda_cat->martes_t) }}"/>
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
										<div class="input-group date col" id="acat_mier_inicio" data-target-input="nearest">
											<input type="text" name="acat_miercoles_i" class="form-control datetimepicker-input" data-target="#acat_mier_inicio" value="{{ old('acat_miercoles_i', $contratista->agenda_cat->mier_i) }}"/>
											<div class="input-group-append" data-target="#acat_mier_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_mier_termino" data-target-input="nearest">
											<input type="text" name="acat_miercoles_t" class="form-control datetimepicker-input" data-target="#acat_mier_termino" value="{{ old('acat_miercoles_t', $contratista->agenda_cat->mier_t) }}"/>
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
										<div class="input-group date col" id="acat_jueves_inicio" data-target-input="nearest">
											<input type="text" name="acat_jueves_i" class="form-control datetimepicker-input" data-target="#acat_jueves_inicio" value="{{ old('acat_jueves_i', $contratista->agenda_cat->jueves_i) }}"/>
											<div class="input-group-append" data-target="#acat_jueves_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_jueves_termino" data-target-input="nearest">
											<input type="text" name="acat_jueves_t" class="form-control datetimepicker-input" data-target="#acat_jueves_termino" value="{{ old('acat_jueves_t', $contratista->agenda_cat->jueves_t) }}"/>
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
										<div class="input-group date col" id="acat_viernes_inicio" data-target-input="nearest">
											<input type="text" name="acat_viernes_i" class="form-control datetimepicker-input" data-target="#acat_viernes_inicio" value="{{ old('acat_viernes_i', $contratista->agenda_cat->viernes_i) }}"/>
											<div class="input-group-append" data-target="#acat_viernes_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_viernes_termino" data-target-input="nearest">
											<input type="text" name="acat_viernes_t" class="form-control datetimepicker-input" data-target="#acat_viernes_termino" value="{{ old('acat_viernes_t', $contratista->agenda_cat->viernes_t) }}"/>
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
										<div class="input-group date col" id="acat_sabado_inicio" data-target-input="nearest">
											<input type="text" name="acat_sabado_i" class="form-control datetimepicker-input" data-target="#acat_sabado_inicio" value="{{ old('acat_sabado_i', $contratista->agenda_cat->sabado_i) }}"/>
											<div class="input-group-append" data-target="#acat_sabado_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_sabado_termino" data-target-input="nearest">
											<input type="text" name="acat_sabado_t" class="form-control datetimepicker-input" data-target="#acat_sabado_termino" value="{{ old('acat_sabado_t', $contratista->agenda_cat->sabado_t) }}"/>
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
										<div class="input-group date col" id="acat_domingo_inicio" data-target-input="nearest">
											<input type="text" name="acat_domingo_i" class="form-control datetimepicker-input" data-target="#acat_domingo_inicio" value="{{ old('acat_domingo_i', $contratista->agenda_cat->domingo_i) }}"/>
											<div class="input-group-append" data-target="#acat_domingo_inicio" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
										<div class="input-group date col" id="acat_domingo_termino" data-target-input="nearest">
											<input type="text" name="acat_domingo_t" class="form-control datetimepicker-input" data-target="#acat_domingo_termino" value="{{ old('acat_domingo_t', $contratista->agenda_cat->domingo_t) }}"/>
											<div class="input-group-append" data-target="#acat_domingo_termino" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>

								</div>
								<div class="modal-footer justify-content-left">
									<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button> -->
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Asignar</button>
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
	$('#fecha_producto_a_obra').datetimepicker({format: 'L', locale: 'es'});
	$('#fecha_producto_a_vivienda').datetimepicker({format: 'L', locale: 'es'});

	$('#atc_lunes_inicio').datetimepicker({format: 'LT'});
	$('#atc_lunes_termino').datetimepicker({format: 'LT'});
	$("#atc_lunes_inicio").on("change.datetimepicker", function (e) { $('#atc_lunes_termino').datetimepicker('minDate', e.date); });
	$("#atc_lunes_termino").on("change.datetimepicker", function (e) { $('#atc_lunes_inicio').datetimepicker('maxDate', e.date); });

	$('#atc_martes_inicio').datetimepicker({format: 'LT'});
	$('#atc_martes_termino').datetimepicker({format: 'LT'});
	$("#atc_martes_inicio").on("change.datetimepicker", function (e) { $('#atc_martes_termino').datetimepicker('minDate', e.date); });
	$("#atc_martes_termino").on("change.datetimepicker", function (e) { $('#atc_martes_inicio').datetimepicker('maxDate', e.date); });

	$('#act_mier_inicio').datetimepicker({format: 'LT'});
	$('#atc_mier_termino').datetimepicker({format: 'LT'});
	$("#act_mier_inicio").on("change.datetimepicker", function (e) { $('#atc_mier_termino').datetimepicker('minDate', e.date); });
	$("#atc_mier_termino").on("change.datetimepicker", function (e) { $('#act_mier_inicio').datetimepicker('maxDate', e.date); });

	$('#atc_jueves_inicio').datetimepicker({format: 'LT'});
	$('#atc_jueves_termino').datetimepicker({format: 'LT'});
	$("#atc_jueves_inicio").on("change.datetimepicker", function (e) { $('#atc_jueves_termino').datetimepicker('minDate', e.date); });
	$("#atc_jueves_termino").on("change.datetimepicker", function (e) { $('#atc_jueves_inicio').datetimepicker('maxDate', e.date); });

	$('#atc_viernes_inicio').datetimepicker({format: 'LT'});
	$('#atc_viernes_termino').datetimepicker({format: 'LT'});
	$("#atc_viernes_inicio").on("change.datetimepicker", function (e) { $('#atc_viernes_termino').datetimepicker('minDate', e.date); });
	$("#atc_viernes_termino").on("change.datetimepicker", function (e) { $('#atc_viernes_inicio').datetimepicker('maxDate', e.date); });

	$('#atc_sabado_inicio').datetimepicker({format: 'LT'});
	$('#atc_sabado_termino').datetimepicker({format: 'LT'});
	$("#atc_sabado_inicio").on("change.datetimepicker", function (e) { $('#atc_sabado_termino').datetimepicker('minDate', e.date); });
	$("#atc_sabado_termino").on("change.datetimepicker", function (e) { $('#atc_sabado_inicio').datetimepicker('maxDate', e.date); });

	$('#atc_domingo_inicio').datetimepicker({format: 'LT'});
	$('#atc_domingo_termino').datetimepicker({format: 'LT'});
	$("#atc_domingo_inicio").on("change.datetimepicker", function (e) { $('#atc_domingo_termino').datetimepicker('minDate', e.date); });
	$("#atc_domingo_termino").on("change.datetimepicker", function (e) { $('#atc_domingo_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_lunes_inicio').datetimepicker({format: 'LT'});
	$('#acat_lunes_termino').datetimepicker({format: 'LT'});
	$("#acat_lunes_inicio").on("change.datetimepicker", function (e) { $('#acat_lunes_termino').datetimepicker('minDate', e.date); });
	$("#acat_lunes_termino").on("change.datetimepicker", function (e) { $('#acat_lunes_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_martes_inicio').datetimepicker({format: 'LT'});
	$('#acat_martes_termino').datetimepicker({format: 'LT'});
	$("#acat_martes_inicio").on("change.datetimepicker", function (e) { $('#acat_martes_termino').datetimepicker('minDate', e.date); });
	$("#acat_martes_termino").on("change.datetimepicker", function (e) { $('#acat_martes_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_mier_inicio').datetimepicker({format: 'LT'});
	$('#acat_mier_termino').datetimepicker({format: 'LT'});
	$("#acat_mier_inicio").on("change.datetimepicker", function (e) { $('#acat_mier_termino').datetimepicker('minDate', e.date); });
	$("#acat_mier_termino").on("change.datetimepicker", function (e) { $('#acat_mier_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_jueves_inicio').datetimepicker({format: 'LT'});
	$('#acat_jueves_termino').datetimepicker({format: 'LT'});
	$("#acat_jueves_inicio").on("change.datetimepicker", function (e) { $('#acat_jueves_termino').datetimepicker('minDate', e.date); });
	$("#acat_jueves_termino").on("change.datetimepicker", function (e) { $('#acat_jueves_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_viernes_inicio').datetimepicker({format: 'LT'});
	$('#acat_viernes_termino').datetimepicker({format: 'LT'});
	$("#acat_viernes_inicio").on("change.datetimepicker", function (e) { $('#acat_viernes_termino').datetimepicker('minDate', e.date); });
	$("#acat_viernes_termino").on("change.datetimepicker", function (e) { $('#acat_viernes_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_sabado_inicio').datetimepicker({format: 'LT'});
	$('#acat_sabado_termino').datetimepicker({format: 'LT'});
	$("#acat_sabado_inicio").on("change.datetimepicker", function (e) { $('#acat_sabado_termino').datetimepicker('minDate', e.date); });
	$("#acat_sabado_termino").on("change.datetimepicker", function (e) { $('#acat_sabado_inicio').datetimepicker('maxDate', e.date); });

	$('#acat_domingo_inicio').datetimepicker({format: 'LT'});
	$('#acat_domingo_termino').datetimepicker({format: 'LT'});
	$("#acat_domingo_inicio").on("change.datetimepicker", function (e) { $('#acat_domingo_termino').datetimepicker('minDate', e.date); });
	$("#acat_domingo_termino").on("change.datetimepicker", function (e) { $('#acat_domingo_inicio').datetimepicker('maxDate', e.date); });
});
</script>
@endpush