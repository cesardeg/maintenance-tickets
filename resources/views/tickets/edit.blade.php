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
				<h1 class="m-0 text-dark">Editar Ticket</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/tickets">
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
				<h3 class="card-title">Ingresa los datos</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" action="/tickets/{{ $ticket->id }}" method="post">
            {{ csrf_field() }}
            @method('PUT')
			<div class="card-body">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ( $errors->all() as $error )
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Desarrollador">Nombre Cliente</label>
								<input type="text" class="form-control" name="NombreCliente" placeholder="Desarrollador" value="{{ $ticket->cliente->nombre }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Teléfono</label>
								<input type="text" class="form-control" name="Telefono" placeholder="Teléfono" value="{{ $ticket->cliente->telefono }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Telefono">Número de cliente</label>
								<input type="text" class="form-control" name="NumeroCliente" placeholder="Número Cliente" value="{{ $ticket->cliente->numero_cliente }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Numero_cat">Ubicación</label>
								<input type="text" class="form-control" name="Ubicacion" placeholder="Ubicación" value="{{ $ticket->cliente->ubicacion }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
                                <label for="Nombre_cat">CAT Asignado</label>
                                <select name="cat_id" id="cat" class="form-control">
                                    @foreach( $coordinadores as $coordinador )
                                        <option value="{{ $coordinador->id }}">{{ $coordinador->user->name }}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Atencion_cat" >Fecha y hora de atención CAT</label>
                                <div class="input-group date" id="Atencion_cat" data-target-input="nearest">
                                    <input type="text" name="Atencion_cat" class="form-control datetimepicker-input" data-target="#Atencion_cat" value="{{ $ticket->cita_cat ?? $ticket->cita_cat ?? old('Atencion_cat') }}"/>
                                    <div class="input-group-append" data-target="#Atencion_cat" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-sm-6">
							<div class="form-group">
                                <label for="Nombre_cat">Contratista Asignado</label>
                                <select name="contratista_id" id="contratista" class="form-control">
                                    @foreach( $contratistas as $contratista )
                                    <option value="{{ $contratista->id }}">{{ $contratista->user->name }}</option>
                                @endforeach
                                </select>
							</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Atencion_contratista" >Fecha y hora de atención Contratista</label>
                                <div class="input-group date" id="Atencion_contratista" data-target-input="nearest">
                                    <input type="text" name="Atencion_contratista" class="form-control datetimepicker-input" data-target="#Atencion_contratista" value="{{ $ticket->cita_contratista ?? $ticket->cita_contratista ?? old('Atencion_contratista') }}"/>
                                    <div class="input-group-append" data-target="#Atencion_contratista" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
							<div class="form-group">
                                <label for="Nombre_cat">Estado</label>
                                <select name="estado" id="cat" class="form-control">
                                    @foreach( $estados as $key => $estado )
                                        <option value="{{ $key }}">{{ $estado }}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="col-sm-6">
							<div class="form-group">
                                <label for="Nombre_cat">Falla</label>
                                <select name="cat_id" id="cat" class="form-control">
                                    @foreach( $fallas as $falla )
                                        <option value="{{ $falla->id }}">{{ $falla->nombre }}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
					</div> <!-- /.row -->
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Editar</button>
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
	$('#Atencion_contratista').datetimepicker({format: 'L', locale: 'es'});
	$('#Atencion_cat').datetimepicker({format: 'L', locale: 'es'});

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