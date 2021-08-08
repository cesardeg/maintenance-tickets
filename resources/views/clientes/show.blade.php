@extends('general.layout')

@push('styles')
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Cliente {{ $cliente->nombre }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/clientes">
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
				<h3 class="card-title">Datos del cliente</h3>
				<!-- card tools -->
				<div class="card-tools">
					<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
				<!-- /.card-tools -->
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Desarrollador">Desarrollador</label>
							<input type="text" class="form-control" name="Desarrollador" value="{{ $cliente->desarrollador }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Municipio">Municipio</label>
							<input type="text" class="form-control" name="Municipio" value="{{ $cliente->municipio }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Condominio">Condominio</label>
							<input type="text" class="form-control" name="Condominio" value="{{ $cliente->condominio->nombre }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Numero_cliente">Número de cliente</label>
							<input type="text" class="form-control" name="Numero_cliente" value="{{ $cliente->numero_cliente }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Nombre_completo">Nombre completo</label>
							<input type="text" class="form-control" name="Nombre_completo" value="{{ $cliente->nombre }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Coopropietario">Coopropietario</label>
							<input type="text" class="form-control" name="Coopropietario" value="{{ $cliente->coopropietario }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Correo">Correo</label>
							<input type="text" class="form-control" name="Correo" value="{{ $cliente->user->email }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Telefono">Teléfono</label>
							<input type="text" class="form-control" name="Telefono" value="{{ $cliente->telefono }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Fecha_escrituracion" >Fecha de escrituración</label>
							<input type="text" class="form-control" name="Fecha_escrituracion"
								value="{{ $cliente->fecha_escrituracion?->format('d/m/Y') }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Fecha_poliza" >Fecha de póliza de garantía</label>
							<input type="text" class="form-control" name="Fecha_poliza"
								value="{{ $cliente->fecha_poliza?->format('d/m/Y') }}" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Fecha_entrega" >Fecha de entrega</label>
							<input type="text" class="form-control" name="Fecha_entrega"
								value="{{ $cliente->fecha_entrega?->format('d/m/Y') }}" disabled>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="Comentarios">Comentarios de la entrega</label>
							<textarea class="form-control" rows="3" name="Comentarios" disabled>{{ $cliente->comentarios }}</textarea>
						</div>
					</div>
				</div> <!-- /.row -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<a href="/clientes/{{ $cliente->id }}/edit">
					<button type="submit" class="btn btn-primary">Editar</button>
				</a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Eliminar</button>
			</div>
		</div>
	</div>

	<div class="card card-secondary">
		<div class="card-header">
			<h3 class="card-title">Historial de tickets</h3>
			<!-- card tools -->
			<div class="card-tools">
				<button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table id="example1" class="table no-padding table-hover table-striped">
				<thead>
				<tr>
					<th>#</th>
					<th>Estado</th>
					<th>Fecha de reporte</th>
					<th style="width: 150px;"></th>
				</tr>
				</thead>
				<tbody>
				@foreach ($tickets as $ticket)
				<tr>
					<td>{{ $ticket->id }}</td>
					<td>{{ $ticket->nombre_estado }}</td>
					<td>{{ date('Y-m-d', strtotime($ticket->created_at)) }}</td>
					<td>
						<a class="btn btn-info" target="_blank" href="{{ route('tickets.show', $ticket->id) }}">
							Ver ticket
						</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		<!-- /.card-body -->
	</div>

	<div class="modal fade" id="modal-danger">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar cliente {{ $cliente->nombre }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Estás seguro que deseas eliminar al cliente {{ $cliente->nombre }}?</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
					<form role="form" action="/clientes/{{ $cliente->id }}" method="post">
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
<script type="text/javascript">
	$(document).ready(function () {
		bsCustomFileInput.init();
	});

  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
			"responsive": true,
			"order": [[0, 'desc']]
    });
  });
</script>
@endpush