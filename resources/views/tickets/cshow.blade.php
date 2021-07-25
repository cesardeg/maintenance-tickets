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
				<h1 class="m-0 text-dark">Dictamen: # {{ $ticket->id }}</h1>
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
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Información</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="CAT">CAT</label>
                            @if (is_null($ticket->cat_id))
                            <input type="text" class="form-control" name="CAT" value="Sin asignar" disabled>
                            @else
                            <input type="text" class="form-control" name="CAT" value="{{ $ticket->coordinador->nombre }}" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Cita">Cita de valoración</label>
                            @if (is_null($ticket->cita_cat))
                            <input type="text" class="form-control" name="Cita" value="Sin asignar" disabled>
                            @else
                            <input type="text" class="form-control" name="Cita" value="{{ date('Y-m-d', strtotime($ticket->cita_cat)) }}" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Cita">Fecha Atención 1</label>
                            @if (is_null($ticket->cita_atencion_1))
                            <input type="text" class="form-control" name="Cita" value="Sin asignar" disabled>
                            @else
                            <input type="text" class="form-control" name="Cita" value="{{ date('d/m/Y h:i A', strtotime($ticket->cita_atencion_1)) }}" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Cita">Fecha Atención 2</label>
                            @if (is_null($ticket->cita_atencion_2))
                            <input type="text" class="form-control" name="Cita" value="Sin asignar" disabled>
                            @else
                            <input type="text" class="form-control" name="Cita" value="{{ date('d/m/Y h:i A', strtotime($ticket->cita_atencion_2)) }}" disabled>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="Cita">Fecha Atención 3</label>
                            @if (is_null($ticket->cita_atencion_3))
                            <input type="text" class="form-control" name="Cita" value="Sin asignar" disabled>
                            @else
                            <input type="text" class="form-control" name="Cita" value="{{ date('d/m/Y h:i A', strtotime($ticket->cita_atencion_3)) }}" disabled>
                            @endif
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
                        <th>Valoración</th>
                        <th>Estado</th>
                        <th>Contratista</th>
                        <th>Observaciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($ticket->detalles as $key => $detalle)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $detalle->familia->nombre }}</td>
                        <td>{{ $detalle->concepto->nombre }}</td>
                        <td>{{ $detalle->falla->nombre }}</td>
                        <td>{{ $detalle->valoracion }}</td>
                        <td>{{ $detalle->estado }}</td>
                        @if ($detalle->contratista == null)
                        <td>Sin asignar</td>
                        @else
                        <td>{{ $detalle->contratista->nombre }}</td>
                        @endif
                        <td><button type="button" onclick="observaciones('{{$detalle->observacion}}')" data-toggle="modal" data-target="#modal-default" class="btn btn-block btn-primary">Ver</button></td>
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
                        <h4 class="modal-title">Observaciones</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="observacion-modal"></p>
                        <hr>
                        <h5>Valoración</h5>
                        <p>{{ $detalle->valoracion }}</p>
                        <h5>Estado</h5>
                        <p>{{ $detalle->estado }}</p>
                        <h5>Contratista</h5>
                        <p>{{ $detalle->contratista == null ? 'Sin asignar' : $detalle->contratista->nombre }}</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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
<script type="text/javascript">
$(document).ready(function () {
	bsCustomFileInput.init();
});

function observaciones(observacion) {
    const pObservacion = document.querySelector('#observacion-modal');
    if (observacion == "") {
        pObservacion.innerHTML = 'Sin observaciones.';
    } else {
        pObservacion.innerHTML = observacion;
    }
}
</script>
@endpush