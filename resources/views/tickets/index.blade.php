@extends('general.layout')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Listado de tickets</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@can('create', App\Ticket::class)
					<li class="breadcrumb-item">
						<a href="{{ route('tickets.create') }}">
							<button type="button" class="btn btn-block btn-primary">Alta de ticket</button>
						</a>
					</li>
					@endcan
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
		@if (session()->has('message'))
		<div class="alert alert-info">
			{{ session('message') }}
		</div>
		@endif
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
						<div class="input-group mb-3 mr-3">
							<div class="input-group-prepend">
								<i class="input-group-text nav-icon fas fa-search"></i>
							</div>
							<input type="text" class="form-control" placeholder="Buscar..." name="buscar" value="{{ request('buscar')  }}">
						</div>
						<div class="input-group mb-3 mr-3">
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
						<div class="input-group mb-3 mr-3">
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
					<table id="example1" class="table no-padding table-hover table-striped">
						<thead>
						<tr>
							<th>Folio</th>
							@unless ( auth()->user()->es_cliente )
							<th>Condominio</th>
							<th>No. Cliente</th>
							<th>Cliente</th>
							@endunless
							@unless ( auth()->user()->es_coordinador )
							<th>CAT</th>
							@endunless
							<th>Fecha de alta</th>
							<th>Estado</th>
							<th style="width: 100px;"></th>
						</tr>
						</thead>
						<tbody>

						@foreach ($tickets as $ticket)
						<tr>
							<td>{{ $ticket->id }}</td>
							@unless ( auth()->user()->es_cliente )
							<td>{{ $ticket->condominio?->nombre }}</td>
							<td>{{ $ticket->cliente->numero_cliente }}</td>
							<td>{{ $ticket->cliente->nombre }}</td>
							@endunless
							@unless ( auth()->user()->es_coordinador )
							<td>{{ $ticket->coordinador?->nombre ?? 'Sin asignar' }}</td>
							@endunless
							<td>{{ $ticket->created_at->format('d-m-Y') }}</td>
							<td>{{ $ticket->nombre_estado }}</td>
							<td>
								<a class="btn btn-info" href="{{ route('tickets.show', $ticket->id) }}">
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
<script src="{{ url('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
			"responsive": true,
			"order": [[0, 'desc']]
    });
  });
</script>
@endpush