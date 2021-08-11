@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="text-right mb-3">
			@can('contestar', $ticket->encuesta)
			<a href="{{ route('encuestas.contestar', $ticket->encuesta->id) }}" class="btn btn-info m-1">
				Contestar encuesta
			</a>
			@else
				@can('view', $ticket->encuesta)
				<a href="{{ route('encuestas.show', $ticket->encuesta->id) }}" class="btn btn-info m-1">
					Ver encuesta
				</a>
				@endcan
			@endcan
			<a href="{{ route('tickets.showPDF', $ticket->id) }}" class="btn btn-primary m-1">
				Descargar PDF
			</a>
			@can('delete', $ticket)
			<button data-toggle="modal" data-target="#modal-eliminar" class="btn btn-danger m-1">
				Eliminar
			</button>
			@endcan
			<a href="{{ route('tickets.index') }}" class="btn btn-secondary m-1">Regresar</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Información general</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Folio</label>
							<p>{{ $ticket->id }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Estado</label>
							<p>{{ $ticket->nombre_estado }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha de reporte</label>
							<p>{{ $ticket->created_at?->format('d/m/Y H:i') }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha de finalizado</label>
							<p>{{ $ticket->fecha_finalizado?->format('d/m/Y') ?? '-'}}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Domicilio</label>
							<p>
								{{ $ticket->condominio?->nombre }}
								{{ $ticket->cliente?->numero_cliente }}
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Prototipo</label>
							<p>
								{{ $ticket->prototipo ?? 'n/a' }}
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Cliente</label>
							<p>
								<a @can('view', $ticket['cliente']) href="{{ route('clientes.show', $ticket->cliente_id) }}" @endcan target="_blank">
									{{ $ticket->cliente?->nombre }}
								</a>
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha poliza</label>
							<p>{{ $ticket->cliente?->fecha_poliza?->format('d/m/Y') }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Teléfono</label>
							<p>
								<a href="tel:{{ $ticket->cliente?->telefono }}">
									{{ $ticket->cliente?->telefono }}
								</a>
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Correo</label>
							<p>
								<a href="mailto:{{ $ticket->cliente?->correo }}">
									{{ $ticket->cliente?->correo }}
								</a>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>CAT Asignado</label>
							@if($ticket->coordinador)
							<p>
								<a @can('view', $ticket['coordinador']) href="{{ route('cat.show', $ticket->cat_id) }}" @endcan target="_blank">
									{{ $ticket->coordinador->nombre }}
								</a>
							</p>
							@else
							<p>Sin asignar</p>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha de cita</label>
							@if($ticket->coordinador && $ticket->cita_cat)
							<p>{{ $ticket->cita_cat?->format('d/m/Y H:i') }}</p>
							@else
							<p>Sin asignar</p>
							@endif
						</div>
					</div>
				</div>
				@if ($ticket->observacion_fin && !Auth::user()->es_cliente)
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Comentarios de finalización</label>
							<p>{{ $ticket->observacion_fin }}</p>
						</div>
					</div>
				</div>
				@endif
            </div>
			<div class="card-footer text-right">
				@can('finalizar', $ticket)
				<button class="btn btn-primary m-1" data-toggle="modal" data-target="#modal-finalizar">
					Finalizar ticket
				</button>
				@endcan
				@can('asignarCat', $ticket)
				<button class="btn btn-primary m-1" data-toggle="modal" data-target="#modal-cat">
					Asignar CAT
				</button>
				@endcan
			</div>
        </div>
		@foreach($ticket->detalles as $i => $detalle)
		@can('view', $detalle)
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">{{ $detalle->toString() }}</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm">
						<div class="form-group">
							<label>Familia</label>
							<p>{{ $detalle->familia?->nombre }}</p>
						</div>
					</div>
					<div class="col-sm">
						<div class="form-group">
							<label>Concepto</label>
							<p>{{ $detalle->concepto?->nombre }}</p>
						</div>
					</div>
					<div class="col-sm">
						<div class="form-group">
							<label>Falla</label>
							<p>{{ $detalle->falla?->nombre ?? '-' }}</p>
						</div>
					</div>
					<div class="col-sm">
						<div class="form-group">
							<label>Ubicación</label>
							<p>{{ $detalle->ubicacion?->nombre }}</p>
						</div>
					</div>
					<div class="col-sm">
						<div class="form-group">
							<label>Dictamen</label>
							<p @switch($detalle['valoracion'])
									@case('Pendiente')
										class="text-muted"
									@break
									@case('Si')
										class="text-success"
									@break
									@case('No')
										class="text-danger"
									@break
								@endswitch>
								{{ $detalle->valoracion_text }}
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						@if($detalle->descripcion)
						<div class="form-group">
							<label>Descripción de la falla</label>
							<p>{{ $detalle->descripcion }}</p>
						</div>
						@endif
					</div>
					<div class="col-sm-6">
						@if($detalle->pending_valoration === false && $detalle->observacion)
						<div class="form-group">
							<label>Observaciones dictamen</label>
							<p>
								{{ $detalle->observacion }}
							</p>
						</div>
						@endif
					</div>
				</div>
				@if ($detalle->manpowers->isNotEmpty())
				<table class="table table-hover table-striped w-100">
					<thead>
						<tr>
							<th>Contratista</th>
							<th>Fecha agendada</th>
							<th>Fecha de atención</th>
							<th>Finalizado</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($detalle->manpowers as $manpower)
						<tr>
							<td class="align-middle">
								<a @can('view', $manpower['contratista']) href="{{ route('contratistas.show', $manpower->contratista_id) }}" @endcan target="_blank">
									{{ $manpower->contratista?->nombre }}
								</a>
							</td>
							<td class="align-middle">
								{{ $manpower->agendado_desde?->format('d/m/Y') }}<br />
								{{ $manpower->agendado_desde?->format('H:i') }} - 
								{{ $manpower->agendado_hasta?->format('H:i') }}
							</td>
							<td class="align-middle">
								@if($manpower->finalizado)
								{{ $manpower->trabajado_desde?->format('d/m/Y') }}<br />
								{{ $manpower->trabajado_desde?->format('H:i') }} - 
								{{ $manpower->trabajado_hasta?->format('H:i') }}
								@else
								-
								@endif
							</td>
							<td class="align-middle">
								{{ $manpower->finalizado ? 'Sí' : 'No' }}
							</td>
							<td class="align-middle">
								@can('delete', $manpower)
								<button class="btn btn-danger btn-block m-1"
									data-action="{{ route('manpowers.destroy', $manpower->id) }}"
									data-falla="{{ $detalle->toString() }}"
									data-contratista="{{ $manpower->contratista?->nombre }}"
									data-toggle="modal"
									data-target="#modal-eliminar-contratista">
									Eliminar
								</button>
								@endcan
								@can('registrarTrabajo', $manpower)
								<button class="btn btn-secondary btn-block m-1"
									data-action="{{ route('manpowers.log', $manpower->id) }}"
									data-falla="{{ $detalle->toString() }}"
									data-contratista="{{ $manpower->contratista?->nombre }}"
									data-desde="{{ old('trabajado_desde', $manpower->trabajado_desde?->format('Y-m-d H:i') ?? $manpower->agendado_desde?->format('Y-m-d H:i')) }}"
									data-hasta="{{ old('trabajado_hasta', $manpower->trabajado_hasta?->format('Y-m-d H:i') ?? $manpower->agendado_hasta?->format('Y-m-d H:i')) }}"
									data-toggle="modal"
									data-target="#modal-trabajo">
									Registrar atención
								</button>
								@endcan
							</td>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
			<div class="card-footer text-right">
				@can('valorar', $detalle)
				<button class="btn btn-primary m-1"
					data-action="{{ route('detalles-ticket.valorar', $detalle->id) }}"
					data-falla="{{ $detalle->toString() }}"
					data-valoracion="{{ $detalle->valoracion }}"
					data-observacion="{{ $detalle->observacion }}"
					data-toggle="modal"
					data-target="#modal-valorar">
					Emitir dictamen
				</button>
				@endcan
				@can('asignarContratista', $detalle)
				<button class="btn btn-primary m-1"
					data-action="{{ route('detalles-ticket.contratistas.store', $detalle->id) }}"
					data-falla="{{ $detalle->toString() }}"
					data-toggle="modal"
					data-target="#modal-contratista">
					Asignar contratista
				</button>
				@endcan
			</div>
		</div>
		@endcan
		@endforeach
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-cat" tabindex="-1">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<form class="modal-content" action="{{ route('tickets.add-cat', $ticket->id) }}" method="post">
			@csrf()
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Asignar coordinador</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="form-group mt-2">
					<label for="select-coordinador">Coordinador de atención técnica</label>
					<select class="form-control select-resource" id="select-coordinador" name="cat_id">
						<option value="" selected>Sin asignar</option>
						@foreach($cats as $cat)
						<option value="{{ $cat->id }}"
							@if(old('cat_id', $ticket['cat_id']) == $cat['id'])
								selected
							@endif>
							{{ $cat->nombre }}
						</option>
						@endforeach
					</select>
					<input
						class="event-start"
						type="hidden"
						name="cita_cat"
						value="{{ old('cita_cat', $ticket->cita_cat?->format('Y-m-d H:i:s')) }}">
					<input
						class="event-end"
						type="hidden"
						name="cita_cat_fin"
						value="{{ old('cita_cat_fin', $ticket->cita_cat_fin?->format('Y-m-d H:i:s')) }}">
				</div><!-- /.col -->
				<div class="text-center text-muted mb-2">
					Selecciona horario de cita en el calendario
				</div>
				<div class="row">
					<div class="col-sm-4 d-flex">
						<div class="alert alert-success flex-grow-1">
							Horario de cita correcto
						</div>
					</div>
					<div class="col-sm-4 d-flex">
						<div class="alert alert-info flex-grow-1">
							Horario de cita es correcto, pero esta en el pasado.
						</div>
					</div>
					<div class="col-sm-4 d-flex">
						<div class="alert alert-warning flex-grow-1">
							Horario de cita no cumple con agenda de CAT o se empalma con otra cita.
						</div>
					</div>
				</div>
				
				<div class="calendar"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Asignar</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-valorar" tabindex="-1">
	<div class="modal-dialog">
		<form class="modal-content" method="post" id="form-valoracion">
			@csrf()
			<div class="modal-header">
				<h5 class="modal-title"">Valorar falla</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Falla</label>
							<p id="falla-valorar"></p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="valoracion">Procede garantía</label>
							<select class="form-control" id="valoracion" name="valoracion">
								<option value="Pendiente">Pendiente</option>
								<option value="Si">Sí</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="observacion">Observaciones dictamen</label>
							<textarea class="form-control" name="observacion" id="observacion" rows="5"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Valorar</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modal-contratista" tabindex="-1">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<form class="modal-content" method="post" id="form-contratista">
			@csrf()
			<div class="modal-header">
				<h5 class="modal-title">
					Asignar contratista - 
					<span id="falla-contratista"></span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="form-group mt-2">
					<label for="select-contratista">Contratista</label>
					<select class="form-control select-resource" id="select-contratista" name="contratista_id" required>
						<option value="" selected disabled>Selecciona contratista</option>
						@foreach($contratistas as $contratista)
						<option value="{{ $contratista->id }}" @if(old('contratista_id') == $contratista['id']) selected @endif>
							{{ $contratista->nombre }}
						</option>
						@endforeach
					</select>
					<input
						class="event-start"
						type="hidden"
						name="agendado_desde"
						value="{{ old('agendado_desde') }}"
						required>
					<input
						class="event-end"
						type="hidden"
						name="agendado_hasta"
						value="{{ old('agendado_hasta') }}"
						required>
				</div><!-- /.col -->
				<div class="text-center text-muted mb-2">
					Selecciona horario de trabajo en el calendario
				</div>
				<div class="row">
					<div class="col-sm-4 d-flex">
						<div class="alert alert-success flex-grow-1">
							Horario de trabajo correcto.
						</div>
					</div>
					<div class="col-sm-4 d-flex">
						<div class="alert alert-info flex-grow-1">
							Horario de trabajo es correcto, pero esta en el pasado.
						</div>
					</div>
					<div class="col-sm-4 d-flex">
						<div class="alert alert-warning flex-grow-1">
							Horario de trabajo no cumple con agenda de contratista o se empalma con otro trabajo.
						</div>
					</div>
				</div>
				
				<div class="calendar"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Asignar</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-trabajo" tabindex="-1">
	<div class="modal-dialog">
		<form class="modal-content" method="post" id="form-trabajo">
			@csrf()
			@method('put')
			<div class="modal-header">
				<h5 class="modal-title">
					Registrar trabajo - 
					<span id="falla-trabajo"></span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Contratista</label>
							<p id="contratista-trabajo"></p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="valoracion">Finalizado</label>
							<select class="form-control" id="finalizado-trabajo" name="finalizado">
								<option value="0">No</option>
								<option value="1">Sí</option>
							</select>
						</div>
					</div>
				</div>	
				<div class="row" id="fechas-trabajo">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="valoracion">Trabajado desde</label>
							<div class="input-group" id="trabajado-desde" data-target-input="nearest">
								<input type="text" name="trabajado_desde" class="form-control datetimepicker-input" data-target="#trabajado-desde" id="desde-trabajo" />
								<div class="input-group-append" data-target="#trabajado-desde" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="valoracion">Trabajado hasta</label>
							<div class="input-group" id="trabajado-hasta" data-target-input="nearest">
								<input type="text" name="trabajado_hasta" class="form-control datetimepicker-input" data-target="#trabajado-hasta" id="hasta-trabajo" />
								<div class="input-group-append" data-target="#trabajado-hasta" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Registrar trabajo</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-eliminar-contratista" tabindex="-1">
	<div class="modal-dialog">
		<form class="modal-content" method="post" id="form-eliminar-contratista">
			@csrf()
			@method('delete')
			<div class="modal-header bg-danger">
				<h5 class="modal-title">
					Eliminar asignacion falla - contratista
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					¿En verdad desea eliminar la asignación de la falla
					<strong class="text-danger" id="falla-eliminar-contratista"></strong> de el/la contratista
					<strong class="text-danger" id="eliminar-contratista"></strong>?
				</p>
				<p>
					Esta accion no podrá ser revertida.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger">Eliminar</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-eliminar" tabindex="-1">
	<div class="modal-dialog">
		<form class="modal-content" action="{{ route('tickets.destroy', $ticket->id) }}" method="post" id="form-eliminar">
			@csrf()
			@method('delete')
			<div class="modal-header bg-danger">
				<h5 class="modal-title">
					Eliminar ticket
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					¿En verdad desea eliminar el ticket con folio #{{ $ticket->id }}?
				</p>
				<p>
					Esta accion no podrá ser revertida.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger">Eliminar</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-finalizar" tabindex="-1">
	<div class="modal-dialog">
		<form class="modal-content" action="{{ route('tickets.finalizar', $ticket->id) }}" method="post" id="form-eliminar">
			@csrf()
			<div class="modal-header">
				<h5 class="modal-title">
					Finalizar ticket
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="valoracion">Fecha de finalizado</label>
					<div class="input-group" id="fecha-finalizado" data-target-input="nearest">
						<input type="text" name="fecha_finalizado" class="form-control datetimepicker-input" data-target="#fecha-finalizado"
							value="{{ old('fecha_finalizado', $ticket->fecha_finalizado) }}" />
						<div class="input-group-append" data-target="#fecha-finalizado" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="observacion_fin">Comentarios</label>
					<textarea id="observacion_fin" class="form-control" cols="2" name="observacion_fin" value="{{ old('observacion_fin') }}"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Finalizar ticket</button>
			</div>
		</form>
	</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/locales-all.min.js"></script>
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
$(window).on('load', function () {
	$('#trabajado-desde, #trabajado-hasta').datetimepicker({
		format: 'YYYY-MM-DD HH:mm',
		useCurrent: false,
		sideBySide: true,
		locale: 'es',
	});

	$('#fecha-finalizado').datetimepicker({
		format: 'YYYY-MM-DD',
		useCurrent: true,
		locale: 'es',
	});

	$('#modal-valorar').on('shown.bs.modal', function (event) {
		const button = $(event.relatedTarget); // Button that triggered the modal
		const action      = button.data('action'); // Extract info from data-* attributes
		const falla       = button.data('falla');
		const valoracion  = button.data('valoracion');
		const observacion = button.data('observacion');

		const modal = $(this);
		modal.find('#form-valoracion').attr('action', action);
  		modal.find('#falla-valorar').text(falla);
  		modal.find('#valoracion').val(valoracion);
  		modal.find('#observacion').val(observacion);
	});

	$('#modal-contratista').on('shown.bs.modal', function (event) {
		const button = $(event.relatedTarget); // Button that triggered the modal
		const action      = button.data('action'); // Extract info from data-* attributes
		const falla       = button.data('falla');

		const modal = $(this);
		modal.find('#form-contratista').attr('action', action);
  		modal.find('#falla-contratista').text(falla);
	});

	$('#modal-trabajo').on('shown.bs.modal', function (event) {
		const button = $(event.relatedTarget); // Button that triggered the modal
		const action = button.data('action'); // Extract info from data-* attributes
		const falla = button.data('falla');
		const desde = button.data('desde');
		const hasta = button.data('hasta');
		const contratista = button.data('contratista');

		const modal = $(this);
		modal.find('#form-trabajo').attr('action', action);
  		modal.find('#falla-trabajo').text(falla);
  		modal.find('#contratista-trabajo').text(contratista);
  		modal.find('#finalizado-trabajo').val('1');
  		modal.find('#desde-trabajo').val(desde);
  		modal.find('#hasta-trabajo').val(hasta);
	});

	$('#finalizado-trabajo').on('change', function () {
		$('#fechas-trabajo').toggle($(this).val() == 1);
	});

	$('#modal-eliminar-contratista').on('shown.bs.modal', function (event) {
		const button = $(event.relatedTarget); // Button that triggered the modal
		const action = button.data('action'); // Extract info from data-* attributes
		const falla = button.data('falla');
		const contratista = button.data('contratista');

		const modal = $(this);
		modal.find('#form-eliminar-contratista').attr('action', action);
  		modal.find('#falla-eliminar-contratista').text(falla);
  		modal.find('#eliminar-contratista').text(contratista);
	});

	$('.table').DataTable({
		paging: false,
		lengthChange: false,
		searching: false,
		ordering: false,
		info: false,
		autoWidth: false,
		responsive: true,
    });
});
</script>
<script>
$(window).on('load', function () {
	const coordinadores = @json($cats->keyBy('id'));
	const oldEventCoordinador = {
		start: '{{ old('cita_cat') }}',
		end: '{{ old('cita_cat_fin') }}',
	};

	const contratistas = @json($contratistas->keyBy('id'));
	const oldEventContratista = {
		start: '{{ old('cita_cat') }}',
		end: '{{ old('cita_cat_fin') }}',
	};

	setUpCalendar({
		modalSelector: '#modal-cat',
		fetchUrl: '{{ route('schedules.coordinador') }}',
		eventId: '{{ $ticket->id }}',
		eventTitle: '#{{ $ticket->id }}',
		prevEvent: oldEventCoordinador,
		resources: coordinadores,
		initialDate:'{{ old('cita_cat', $ticket->cita_cat) }}' || undefined,
	});

	setUpCalendar({
		modalSelector: '#modal-contratista',
		fetchUrl: '{{ route('schedules.contratista') }}',
		eventId: new Date().getTime(),
		eventTitle: '#{{ $ticket->id }}',
		prevEvent: oldEventContratista,
		resources: contratistas,
	});

	function setUpCalendar({ modalSelector, fetchUrl, eventId, eventTitle, prevEvent, resources, initialDate }) {
		const modal = $(modalSelector);
		const calendar = new FullCalendar.Calendar(modal.find('.calendar').get(0), {
			themeSystem: 'bootstrap',
			initialView: 'timeGridWeek',
			locale: 'es',
			firstDay: 0,
			allDaySlot: false,
			forceEventDuration: true,
			defaultTimedEventDuration: '0:30',
			stickyHeaderDates: true,
			nowIndicator: true,
			eventResize({ event }) {
				onEventChange(event);
			},
			eventDrop({ event }) {
				onEventChange(event);
			},
			eventClassNames ({ event, isPast }) {
				if (!event.startEditable) {
					return ['alert-secondary'];
				}
				if(isOverlapping(event) || isNotBusinessHour(event)) {
					return ['alert-warning'];
				}
				if (isPast) {
					return ['alert-info'];
				}
				return ['alert-success'];
			},
			initialDate,
		});

		modal.on('shown.bs.modal', function () {
			calendar.render();
			modal.find('.select-resource').trigger('change');
		});

		modal.find('.select-resource').on('change', function () {
			const resId = this.value;
			calendar.setOption('businessHours', resources[resId] && resources[resId].working_hours);
			calendar.setOption('events', fetchEvents(resId));
			calendar.setOption('dateClick', dateClickHandler(resId));
		});

		const fetchEvents = (resId) => {
			if (!resId) {
				onEventChange();
				return [];
			}
			return (info, successCallback, failureCallback) => {
				$.ajax({
					type: 'GET',
					url: fetchUrl,
					data: {
						start: info.startStr,
						end: info.endStr,
						resource_id: resId,
					},
					success(response) {
						const event = prevEvent.start
							? prevEvent
							: response.find((event) => event.id == eventId);
						const items = response.filter((event) => event.id != eventId);

						if (event) {
							Object.assign(event, {
								id: eventId,
								title: eventTitle,
								start: new Date(event.start),
								end: new Date(event.end),
								editable: true,
								durationEditable: true,
							});
							items.push(event);
							onEventChange(event);
						}
						successCallback(items);
					},
					error: failureCallback,
				});
			};
		};

		const dateClickHandler = (resId) => {
			if (!resId) {
				return null;
			}
			return function(info) {
				let event = calendar.getEvents().find((e) => e.id == eventId);
				if (!event) {
					event = calendar.addEvent({
						id: eventId,
						title: eventTitle,
						start: info.date,
						editable: true,
						durationEditable: true,
					}, true);
				} else {
					event.setStart(info.date, { maintainDuration: true });
				}
				onEventChange(event);
			};
		};

		const isNotBusinessHour = (event) => {
			let businessHours = calendar.getOption('businessHours');
			if (!businessHours) {
				return false;
			}
			if(!(businessHours instanceof Array)) {
				businessHours = [businessHours];
			}
			const day = event.start.getDay();
			const start = event.start.toTimeString().slice(0, 5);
			const end = event.end.toTimeString().slice(0, 5);
			return !businessHours.some(
				(info) => info.daysOfWeek.includes(day) && start >= info.startTime && end <= info.endTime
			);
		}

		const isOverlapping = (event) => {
			const events = calendar.getEvents();
			return events.some((e) => {
				if (e.id == event.id) {
					return false;
				}
				const e1start = e.start.getTime();
				const e1end = e.end.getTime();
				const e2start = event.start.getTime();
				const e2end = event.end.getTime();
				return (e1start >= e2start && e1start < e2end || e2start >= e1start && e2start < e1end);
			});
		}

		const onEventChange = (event = null) => {
			const start = event ? formatDate(event.start) : '';
			const end = event ? formatDate(event.end) : '';
			modal.find('.event-start').val(start);
			modal.find('.event-end').val(end);
		};

		const formatDate = (date) =>
			date.getFullYear() + "-" +
			("00" + (date.getMonth() + 1)).slice(-2) + "-" +
			("00" + date.getDate()).slice(-2) + " " +
			("00" + date.getHours()).slice(-2) + ":" +
			("00" + date.getMinutes()).slice(-2) + ":" +
			("00" + date.getSeconds()).slice(-2);
	}
});
</script>
@endpush