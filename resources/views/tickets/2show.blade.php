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
				<h1 class="m-0 text-dark">Dictamen: # {{ $ticket->id }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
                    @if (($ticket->estado == "Terminada" AND auth()->user()->type == 'user') && $ticket->encuestas->first()->active)
                    <li class="px-2">
                        <a href="/encuesta/{{$ticket->id}}">
							<button type="button" class="btn btn-block btn-secondary">Contestar encuesta</button>
						</a>
                    </li>
                    @endif
                    @if (!$ticket->encuestas->first()->active && !is_null($ticket->encuestas->first()->pregunta_1))
                    <li class="px-2">
                        <a href="/encuesta/{{$ticket->id}}">
							<button type="button" class="btn btn-block btn-secondary">Ver encuesta</button>
						</a>
                    </li>
                    @endif
                    @if (auth()->user()->type == 'user')
                    <li class="px-2">
                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-eliminar">Eliminar ticket</button>
                    </li>
                    @endif
                    <li class="px-2">
                        <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-user">Datos del usuario</button>
                    </li>
                    @if (auth()->user()->type == 'user')
                    <li class="px-2">
                        <a href="/generarDictamen/{{ $ticket->id }}">
                            <button type="button" class="btn btn-block btn-info" onclick="notReload()">Generar PDF</button>
                        </a>
                    </li>
                    @endif
					<li class="px-2">
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
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Información</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
                <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="CAT">CAT</label>
                            <div class="input-group">
                                <select id="cats" class="form-control" name="CAT"  @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif >
                                    <option value="none" {{ old('CAT') == 'none' ? 'selected' : '' }}>Sin Asignar</option>
                                    @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}" {{ old('CAT', $ticket->cat_id) == $cat->id ? 'selected' : '' }} >{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarCat()" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Cita">Cita de valoración</label>
                            <div class="input-group date" id="cita" data-target-input="nearest">
                                <input type="text" name="Cita" id="cita-input" class="form-control datetimepicker-input" data-target="#cita" value="{{ old('Cita', $cita = (is_null($ticket->cita_cat)) ? '' : date('d/m/Y', strtotime($ticket->cita_cat)) ) }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif />
                                <div class="input-group-append" data-target="#cita" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarCita()" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Atencion1">Fecha Atención 1</label>
                            <div class="input-group date" id="Atencion1" data-target-input="nearest">
                                <input type="text" name="Atencion1" id="Atencion1-input" class="form-control datetimepicker-input" data-target="#Atencion1" value="{{ old('Atencion1', $cita_atencion_1 = (is_null($ticket->cita_atencion_1)) ? '' : date('d/m/Y h:i A', strtotime($ticket->cita_atencion_1)) ) }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif />
                                <div class="input-group-append" data-target="#Atencion1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarAtencion(1)" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Atencion2">Fecha Atención 2</label>
                            <div class="input-group date" id="Atencion2" data-target-input="nearest">
                                <input type="text" name="Atencion2" id="Atencion2-input" class="form-control datetimepicker-input" data-target="#Atencion2" value="{{ old('Atencion2', $cita_atencion_2 = (is_null($ticket->cita_atencion_2)) ? '' : date('d/m/Y h:i A', strtotime($ticket->cita_atencion_2)) ) }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif />
                                <div class="input-group-append" data-target="#Atencion2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarAtencion(2)" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Atencion3">Fecha Atención 3</label>
                            <div class="input-group date" id="Atencion3" data-target-input="nearest">
                                <input type="text" name="Atencion3" id="Atencion3-input" class="form-control datetimepicker-input" data-target="#Atencion3" value="{{ old('Atencion3', $cita_atencion_3 = (is_null($ticket->cita_atencion_3)) ? '' : date('d/m/Y h:i A', strtotime($ticket->cita_atencion_3)) ) }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif />
                                <div class="input-group-append" data-target="#Atencion3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarAtencion(3)" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Desarrollo">Desarrollo</label>
                            <input type="text" class="form-control" name="Desarrollo" value="{{ $ticket->cliente->desarrollador }}" disabled>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Domicilio">Domicilio</label>
                            <input type="text" class="form-control" id="Domicilio" name="Domicilio" value="{{ $ticket->cliente->condominio->nombre }} {{ $ticket->cliente->numero_cliente }}" disabled>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Fecha_reporte">Fecha de reporte</label>
                            <div class="input-group date" id="Fecha_reporte" data-target-input="nearest">
                                <input type="text" name="Fecha_reporte" id="Fecha_reporte-input" class="form-control datetimepicker-input" data-target="#Fecha_reporte" value="{{ old('Fecha_reporte', date('d/m/Y', strtotime($ticket->created_at)) ) }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif />
                                <div class="input-group-append" data-target="#Fecha_reporte" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="asignarFechaReporte()" class="btn btn-primary">Cambiar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Fecha_poliza">Fecha de póliza</label>
                            <input type="text" class="form-control" name="Fecha_poliza" value="{{ $ticket->cliente->fecha_poliza }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Prototipo">Prototipo</label>
                            <div class="input-group" id="prototipo" data-target-input="nearest">
                                <input type="text" class="form-control" id="Prototipo" name="Prototipo" value="{{ $ticket->prototipo }}" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif >
                                @if($ticket->estado != 'Terminada' AND auth()->user()->type == 'user')
                                <button type="button" onclick="agregarPrototipo()" class="btn btn-primary">Asignar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <table id="example1" class="table no-padding table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Familia</th>
                        <th>Componente</th>
                        <th>Falla</th>
                        <th>Ubicación</th>
                        <th>Procede valoración</th>
                        <th>Estado</th>
                        <th>Contratista</th>
                        <th>Detalles</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($ticket->detalles as $key => $detalle)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detalle->familia->nombre }}</td>
                        <td>{{ $detalle->concepto->nombre }}</td>
                        <td>{{ $detalle->falla->nombre }}</td>
                        <td>{{ $detalle->ubicacion->nombre }}</td>
                        <td>{{ $detalle->valoracion }}</td>
                        <td>{{ $detalle->estado }}</td>
                        @if ($detalle->contratista == null)
                        <td>Sin asignar</td>
                        @else
                        <td>{{ $detalle->contratista->nombre }}</td>
                        @endif
                        {{-- @dd($detalle->estado) --}}
                        <td><button id="fila_{{ $key }}" type="button" onclick="observaciones('{{ $detalle->id }}', '{{ $key+1 }}')" data-toggle="modal" data-target="#modal-default" class="btn btn-block btn-primary">Ver</button></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            <!-- /.card-body -->
            </div>
        </div>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalle de la falla</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Asignar Contratista</h5>
                        <select id="Contratistas" class="form-control" name="contratistas" onchange="asignarContratista()" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif >
                            <option id="none" value="none" {{ old('contratistas') == 'none' ? 'selected' : '' }}>Sin Asignar</option>
                            @foreach ($contratistas as $contratista)
                            <option id="cont_{{ $contratista->id }}" value="{{ $contratista->id }}" {{ old('contratistas', $ticket->contratista_id) == $contratista->id ? 'selected' : '' }} >{{ $contratista->nombre }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <h5>Procede valoración</h5>
                        <select id="Valoracion" class="form-control" name="valoracion" onchange="cambiarValoracion()" @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif >
                            <option id="Pendiente" value="Pendiente" {{ old('Estado') == 'Pendiente' ? 'selected' : ''  }}>Pendiente</option>
                            <option id="Si" value="Si" {{ old('Estado') == 'Si' ? 'selected' : '' }}>Si</option>
                            <option id="No" value="No" {{ old('Estado') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        <hr>
                        <h5>Ubicacion</h5>
                        <select id="Ubicaciones" class="form-control" name="ubicacion" onchange="cambiarUbicacion()"  @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif >
                            <option id="none" value="none" {{ old('ubicacion') == 'none' ? 'selected' : '' }}>Sin Asignar</option>
                            @foreach ($ubicaciones as $ubicacion)
                            <option id="cont_{{ $ubicacion->id }}" value="{{ $ubicacion->id }}" {{ old('ubicacion', $ticket->ubicacion_id) == $ubicacion->id ? 'selected' : '' }} >{{ $ubicacion->nombre }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <h5>Estado</h5>
                        <select id="Estados" class="form-control" name="Estado" onchange="cambiarEstado()" @if(auth()->user()->type != 'user') disabled @endif>
                            <option id="Espera" value="Espera" {{ old('Estado') == 'Espera' ? 'selected' : '' }}>Espera</option>
                            <option id="En proceso" value="En proceso" {{ old('Estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                            <option id="Terminada" value="Terminada" {{ old('Estado') == 'Terminada' ? 'selected' : ''  }}>Terminada</option>
                        </select>
                        <hr>
                        <h5>Observaciones</h5>
                        <textarea  class="form-control" type="text" name="Observaciones" id="Observaciones" onfocusout="agregarObservaciones()"  @if($ticket->estado == 'Terminada' OR auth()->user()->type != 'user') disabled @endif ></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-user">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Nombre</h5>
                        <input class="form-control" type="text" value="{{ $ticket->cliente->nombre }}" disabled>
                        <hr>
                        <h5>Correo</h5>
                        <input class="form-control" type="text" value="{{ $ticket->cliente->user->email }}" disabled>
                        <hr>
                        <h5>Telefono</h5>
                        <input class="form-control" type="text" value="{{ $ticket->cliente->telefono }}" disabled>
                        <hr>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#modal-cambiar-usuario">Cambiar cliente</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-cambiar-usuario">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
							<label>Seleccione al cliente</label>
							<select id="Cliente" class="form-control select2" name="Cliente" style="width: 100%; height: 40px;">
								@foreach ($clientes as $cliente)
								<option value="{{ $cliente->id }}" @if ($ticket->cliente_id == $cliente->id) selected @endif >{{ $cliente->condominio->nombre }} - {{ $cliente->numero_cliente }} / {{ $cliente->nombre }}</option>
								@endforeach
							</select>
						</div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" onclick="cambiarCliente()" class="btn btn-success" data-dismiss="modal">Cambiar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-eliminar">
            <div class="modal-dialog">
                <div class="modal-content bg-warning">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar el ticket del dictamen {{ $ticket->id }}?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <form role="form" action="/tickets/{{ $ticket->id }}" method="post">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-outline-danger">Eliminar</button>
					</form>
                        <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Eliminar</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
	</div>
</section>
@endsection

@push('scripts')
<script src="{{ url('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
	bsCustomFileInput.init();
});

$('.select2').select2()

$(function () {
	$('#cita').datetimepicker({
		format: 'L',
		locale: 'es'
    });
    
    $('#Fecha_reporte').datetimepicker({
		format: 'L',
		locale: 'es'
	});

    $('#Atencion1').datetimepicker({
		locale: 'es',
        format: 'L h:mm A',
        sideBySide: true
	});

    $('#Atencion2').datetimepicker({
		locale: 'es',
        format: 'L h:mm A',
        sideBySide: true
	});

    $('#Atencion3').datetimepicker({
		locale: 'es',
        format: 'L h:mm A',
        sideBySide: true
	});
});

let detalleId = null;
let filaDetalle = null;

function observaciones(detalle_id, key) {
    const opcionContratista = document.querySelector('#Contratistas');
    const opcionValoracion = document.querySelector('#Valoracion');
    const opcionEstado = document.querySelector('#Estados');
    const opcionObservacion = document.querySelector('#Observaciones');
    const opcionUbicaciones = document.querySelector('#Ubicaciones');

    filaDetalle = key;
    detalleId = detalle_id;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/detalle',
		data: { 'id': detalle_id },
		type: 'POST',
		success: (response) => {
            let detalle = response.detalle
            console.log(response.detalle)
            if(detalle.contratista_id != null) {
                opcionContratista.options.namedItem(`cont_${detalle.contratista_id}`).selected = true;
            } else {
                opcionContratista.options.namedItem('none').selected = true;
            }
            opcionValoracion.options.namedItem(detalle.valoracion).selected = true;
            opcionEstado.options.namedItem(detalle.estado).selected = true;
            opcionObservacion.value = detalle.observacion

            if(detalle.ubicacion_id != null) {
                opcionUbicaciones.options.namedItem(`cont_${detalle.ubicacion_id}`).selected = true;
            } else {
                opcionUbicaciones.options.namedItem('none').selected = true;
            }
		},
		error: (error) => {
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function agregarObservaciones() {
    const observacion = document.querySelector('#Observaciones').value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/setObservacion',
		data: { 'id': detalleId, 'observacion': observacion },
		type: 'POST',
		success: (response) => {
			toastr.info(response.mensaje)
		},
		error: (error) => {
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function asignarCat() {
    const ticketid = document.querySelector('#ticket_id').value;
    const seleccionado = document.querySelector('#cats').value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/setCat',
		data: { 'id': ticketid, 'catSeleccionado': seleccionado },
		type: 'POST',
		success: (response) => {
			toastr.info(response.mensaje)
		},
		error: (error) => {
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function asignarCita() {
    const ticketid = document.querySelector('#ticket_id').value;
    const cita = document.querySelector('#cita-input').value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/setCita',
		data: { 'id': ticketid, 'cita': cita },
		type: 'POST',
		success: (response) => {
            console.log(response);
			toastr.info(response.mensaje)
		},
		error: (error) => {
            console.log(error);
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function asignarAtencion(numeroCita) {
    const ticketid = document.querySelector('#ticket_id').value;
    const citaAtencion = document.querySelector(`#Atencion${numeroCita}-input`).value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/setCitaAtencion',
		data: { 'id': ticketid, 'citaAtencion': citaAtencion, 'numeroCita': numeroCita},
		type: 'POST',
		success: (response) => {
            console.log(response);
			toastr.info(response.mensaje)
		},
		error: (error) => {
            console.log(error);
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function asignarFechaReporte() {
    const ticketid = document.querySelector('#ticket_id').value;
    const fechaReporte = document.querySelector(`#Fecha_reporte-input`).value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/setFechaReporte',
		data: { 'id': ticketid, 'fechaReporte': fechaReporte},
		type: 'POST',
		success: (response) => {
            console.log(response);
			toastr.info(response.mensaje)
		},
		error: (error) => {
            console.log(error);
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function agregarPrototipo() {
    const ticketid = document.querySelector('#ticket_id').value;
    const prototipo = document.querySelector('#Prototipo').value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/setPrototipo',
		data: { 'id': ticketid, 'prototipo': prototipo },
		type: 'POST',
		success: (response) => {
			toastr.info(response.mensaje)
		},
		error: (error) => {
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}

function cambiarValoracion() {
    const seleccionado = document.querySelector('#Valoracion').selectedOptions[0].value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/changeValoracion',
		data: { 'id': detalleId, 'valoracion': seleccionado },
		type: 'POST',
		success: (response) => {
            toastr.info(response.mensaje)
            location.reload();
		},
		error: (error) => {
            console.log(error)
			toastr.error('Ocurrió un error inesperado.')
		}
    });

    actualizarValoracion(seleccionado, filaDetalle);
}


function cambiarUbicacion() {
    const seleccionado = document.querySelector('#Ubicaciones').selectedOptions[0].value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/setUbicacion',
		data: { 'id': detalleId, 'ubicacion': seleccionado },
		type: 'POST',
		success: (response) => {
            console.log(response)
            toastr.info(response.mensaje)
		},
		error: (error) => {
            console.log(error)
			toastr.error('Ocurrió un error inesperado.')
		}
    });
}


function cambiarEstado() {
    const seleccionado = document.querySelector('#Estados').selectedOptions[0].value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/changeEstado',
		data: { 'id': detalleId, 'estado': seleccionado },
		type: 'POST',
		success: (response) => {
			toastr.info(response.mensaje)
            location.reload();
		},
		error: (error) => {
			toastr.error('Ocurrió un error inesperado.')
		}
    });

    actualizarEstado(seleccionado, filaDetalle);
}

function asignarContratista() {
    const seleccionado = document.querySelector('#Contratistas').selectedOptions[0].value;

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/setCont',
		data: { 'id': detalleId, 'contSeleccionado': seleccionado },
		type: 'POST',
		success: (response) => {
            console.log(response)
			toastr.info(response.mensaje)
		},
		error: (error) => {
            console.log(error)
			toastr.error('Ocurrió un error inesperado.')
		}
    });
    actualizarContratista(document.querySelector('#Contratistas').selectedOptions[0].textContent, filaDetalle);
}

function actualizarValoracion(valoracion, filaDetalle){
    document.querySelector('#example1').rows[filaDetalle].cells[4].textContent = valoracion;
}

function actualizarEstado(estado, filaDetalle){
    document.querySelector('#example1').rows[filaDetalle].cells[5].textContent = estado;
}

function actualizarContratista(cont, filaDetalle){
    if(cont == 'none'){
        cont = 'Sin asignar';
    }
    document.querySelector('#example1').rows[filaDetalle].cells[6].textContent = cont;
}

function notReload(e){
    e.preventDefault();
}

function cambiarCliente() {
    const cliente = document.querySelector('#Cliente').value

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/detallesTicket/cambiarCliente',
		data: { 'id': {{ $ticket->id }}, 'cliente': cliente },
		type: 'POST',
		success: (response) => {
			toastr.info(response.mensaje)
            location.reload();
		},
		error: (error) => {
            console.log(error)
			toastr.error('Ocurrió un error inesperado.')
		}
	});
}
</script>
@endpush