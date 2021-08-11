@extends('general.layout')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="mb-1 text-dark">Listado de tickets</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@can('create', 'App\Models\Ticket')
					<li class="breadcrumb-item">
						<a href="{{ route('tickets.create') }}">
							<button type="button" class="btn btn-block btn-primary">Crear ticket</button>
						</a>
					</li>
					@endcan
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form class="form-inline">
						<div class="input-group mb-3 mr-md-3">
							<div class="input-group-prepend">
								<i class="input-group-text nav-icon fas fa-search"></i>
							</div>
							<input type="text" class="form-control" placeholder="Buscar..." name="buscar" value="{{ request('buscar')  }}">
						</div>
						<div class="input-group mb-3 mr-md-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="condominio">Condominio</label>
							</div>
							<select class="custom-select" id="condominio" name="condominio_id">
								<option value="" selected>Todos</option>
								@foreach ($condominios as $condominio)
								<option value="{{ $condominio->id }}" {{ request('condominio_id') == $condominio['id'] ? 'selected' : '' }}>
									{{ $condominio->nombre }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="input-group mb-3 mr-md-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="estado">Estado</label>
							</div>
							<select class="custom-select" id="estado" name="estado">
								<option value="" selected>Todos</option>
								@foreach ($estados as $value => $label)
								<option value="{{ $value }}" {{ request('estado', -1) == $value ? 'selected' : '' }}>
									{{ $label }}
								</option>
								@endforeach
							</select>
						</div>
						<div class="mb-3 flex-grow-1 text-right">
							<button type="submit" class="btn btn-secondary">Buscar</button>
						</div>
					</form>
					<table id="example1" class="table no-padding table-hover table-striped w-100">
						<thead>
						<tr>
							<th data-priority="1">Folio</th>
							@unless ( auth()->user()->es_cliente )
							<th>Condominio</th>
							<th>No. Cliente</th>
							<th data-priority="2">Cliente</th>
							@endunless
							@unless ( auth()->user()->es_coordinador )
							<th>CAT</th>
							@endunless
							<th>Fecha de reporte</th>
							<th data-priority="2">Estado</th>
							<th style="width: 100px;"></th>
						</tr>
						</thead>
						<tbody>

						@foreach ($tickets as $ticket)
						<tr>
							<td class="align-middle">
								<a @can('view', $ticket) href="{{ route('tickets.show', $ticket->id) }}" @endcan>
									{{ $ticket->id }}
								</a>
							</td>
							@unless ( auth()->user()->es_cliente )
							<td class="align-middle">{{ $ticket->condominio?->nombre }}</td>
							<td class="align-middle">{{ $ticket->cliente->numero_cliente }}</td>
							<td class="align-middle">{{ $ticket->cliente->nombre }}</td>
							@endunless
							@unless ( auth()->user()->es_coordinador )
							<td class="align-middle">{{ $ticket->coordinador?->nombre ?? 'Sin asignar' }}</td>
							@endunless
							<td class="align-middle">{{ $ticket->created_at->format('d/m/Y') }}</td>
							<td class="align-middle">{{ $ticket->nombre_estado }}</td>
							<td class="align-middle">
								<a class="btn btn-info btn-block" href="{{ route('tickets.show', $ticket->id) }}">
									Ver
								</a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="pull-right mt-3">
						{{ $tickets->render() }}
					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>

@endsection

@push('scripts')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $('#example1').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"responsive": true,
    });
  });
</script>
@endpush