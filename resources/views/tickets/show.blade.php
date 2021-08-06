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
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Información general</h3>
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
							<label>Fecha de reporte</label>
							<p>{{ $ticket->created_at }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Condominio</label>
							<p>{{ $ticket->condominio?->nombre }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>No. Cliente</label>
							<p>
								<a href="{{ route('clientes.show', $ticket->cliente_id) }}">
									{{ $ticket->cliente?->numero_cliente }}
								</a>
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Cliente</label>
							<p>
								<a href="{{ route('clientes.show', $ticket->cliente_id) }}">
									{{ $ticket->cliente?->nombre }}
								</a>
							</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Teléfono</label>
							<p>{{ $ticket->cliente?->telefono }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha poliza</label>
							<p>{{ $ticket->cliente?->fecha_poliza }}</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Estado</label>
							<p>{{ $ticket->nombre_estado }}</p>
						</div>
					</div>
				</div>
            </div>
        </div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Fallas reportadas</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>CAT Asignado</label>
							@if($ticket->coordinador)
							<p>{{ $ticket->coordinador->numero_cat }} {{ $ticket->coordinador->nombre }}</p>
							@else
							<p>Sin asignar</p>
							@endif
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Fecha de cita</label>
							@if($ticket->coordinador && $ticket->cita_cat)
							<p>{{ $ticket->cita_cat }}</p>
							@else
							<p>Sin asignar</p>
							@endif
						</div>
					</div>
					@can('asignarCat', $ticket)
					<div class="col-sm-2 d-flex align-items-center justify-content-end">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal-cat">
							Asignar CAT
						</button>
					</div>
					@endcan
				</div>
				@foreach($ticket->detalles as $i => $detalle)
				<div class="">
					<div class="row border-top mt-3 pt-3">
						<div class="col-sm-2">
							<div class="form-group">
								<label>Familia</label>
								<p>{{ $detalle->familia?->nombre }}</p>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Concepto</label>
								<p>{{ $detalle->concepto?->nombre }}</p>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Falla</label>
								<p>{{ $detalle->falla?->nombre }}</p>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Ubicación</label>
								<p>{{ $detalle->ubicacion?->nombre }}</p>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Procede</label>
								<p>{{ $detalle->valoracion }}</p>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Estado</label>
								@if($detalle->valoracion == 'Si')
								<p>{{ $detalle->estado }}</p>
								@else
								<p>-</p>
								@endif
							</div>
						</div>
						
						<div class="col-sm-12 text-right">
							@can('valorar', $detalle)
							<button class="btn btn-primary"
								data-action="{{ route('detalles-ticket.valorar', $detalle->id) }}"
								data-falla="{{ $detalle->toString() }}"
								data-valoracion="{{ $detalle->valoracion }}"
								data-observacion="{{ $detalle->observacion }}"
								data-toggle="modal"
								data-target="#modal-valorar">
								Valorar
							</button>
							@endcan
							@can('asignarContratista', $detalle)
							<button class="btn btn-primary">Asignar contratista</button>
							@endcan
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
    </div>
</section>
@can('asignarCat', $ticket)
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
					<select class="form-control" id="select-coordinador" name="cat_id">
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
					<input type="hidden" name="cita_cat" value="{{ old('cita_cat', $ticket->cita_cat?->format('Y-m-d H:i:s')) }}">
					<input type="hidden" name="cita_cat_fin" value="{{ old('cita_cat_fin', $ticket->cita_cat_fin?->format('Y-m-d H:i:s')) }}">
				</div><!-- /.col -->
				<div class="text-center text-muted mb-2">
					Selecciona horario de cita en el calendario
				</div>
				<div class="row">
					<div class="col-sm-6 d-flex">
						<div class="alert alert-success flex-grow-1">
							Horario de cita correcto
						</div>
					</div>
					<div class="col-sm-6 d-flex">
						<div class="alert alert-warning flex-grow-1">
							Horario de cita no cumple con agenda de CAT o se empalma con otra cita.
						</div>
					</div>
				</div>
				
				<div id='calendar'></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Asignar</button>
			</div>
		</form>
	</div>
</div>
@endcan

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
							<p id="falla"></p>
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
							<label for="observacion">Observaciones</label>
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/locales-all.min.js"></script>
<script>
$(window).on('load', function () {
	const cats = @json($cats->keyBy('id'));
	const oldTicket = {
		id: '{{ $ticket->id }}',
		title: '#{{ $ticket->id }}',
		start: '{{ old('cita_cat') }}',
		end: '{{ old('cita_cat_fin') }}',
	};

	const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
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
		eventClassNames ({ event }) {
			if (!event.startEditable) {
				return ['alert-secondary'];
			}
			if(isOverlapping(event) || isNotBusinessHour(event)) {
				return ['alert-warning'];
			}
			return ['alert-success'];
		},
	});

	$('#modal-cat').on('shown.bs.modal', function () {
		calendar.render();
		$('#select-coordinador').trigger('change');
	});

	$('#select-coordinador').on('change', function () {
		const catId = this.value;
		calendar.setOption('businessHours', cats[catId] && cats[catId].working_hours);
		calendar.setOption('events', fetchEvents(catId));
		calendar.setOption('dateClick', dateClickHandler(catId));
	});

	$('#modal-valorar').on('shown.bs.modal', function (event) {
		const button = $(event.relatedTarget); // Button that triggered the modal
		const action      = button.data('action'); // Extract info from data-* attributes
		const falla       = button.data('falla');
		const valoracion  = button.data('valoracion');
		const observacion = button.data('observacion');

		const modal = $(this);
		modal.find('#form-valoracion').attr('action', action);
  		modal.find('#falla').text(falla);
  		modal.find('#valoracion').val(valoracion);
  		modal.find('#observacion').val(observacion);
	});

	fetchEvents = (catId) => {
		if (!catId) {
			onEventChange();
			return [];
		}
		return (info, successCallback, failureCallback) => {
			$.ajax({
				type: 'GET',
				url: '{{ route('cat.schedule.index') }}',
				data: {
					start: info.startStr,
					end: info.endStr,
					cat_id: catId,
				},
				success(response) {
					const currentId = '{{ $ticket->id }}';
					const event = oldTicket.start
						? oldTicket
						: response.find((event) => event.id == currentId);
					const items = response.filter((event) => event.id != currentId);

					if (event) {
						Object.assign(event, {
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

	dateClickHandler = (catId) => {
		if (!catId) {
			return null;
		}
		return function(info) {
			let event = calendar.getEvents().find((e) => e.id == '{{ $ticket->id }}');
			if (!event) {
				event = calendar.addEvent({
					id: '{{ $ticket->id }}',
					title: '#{{ $ticket->id }}',
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
		$('[name=cita_cat]').val(start);
		$('[name=cita_cat_fin]').val(end);
	};

	var formatDate = (date) =>
		date.getFullYear() + "-" +
		("00" + (date.getMonth() + 1)).slice(-2) + "-" +
		("00" + date.getDate()).slice(-2) + " " +
		("00" + date.getHours()).slice(-2) + ":" +
		("00" + date.getMinutes()).slice(-2) + ":" +
		("00" + date.getSeconds()).slice(-2);

});
</script>
@endpush