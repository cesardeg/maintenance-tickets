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
				<h1 class="m-0 text-dark">Coordinador de atencion tecnica</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/cat/create">
							<button type="button" class="btn btn-block btn-primary">Registrar CAT</button>
						</a>
					</li>
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
					<table id="example1" class="table no-padding table-hover table-striped">
						<thead>
						<tr>
							<th>#</th>
							<th>Número de CAT</th>
							<th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
							<th style="width: 100px;"></th>
						</tr>
						</thead>
						<tbody>

						@foreach ($cats as $cat)
						<tr>
							<td>{{ $cat->id }}</td>
							<td>{{ $cat->numero_cat }}</td>
							<td>{{ $cat->nombre }}</td>
              <td>{{ $cat->user->email }}</td>
              <td>{{ $cat->telefono }}</td>
							<td><a href="/cat/{{ $cat->id }}"><button type="button" class="btn btn-block btn-info">Detalle</button></a></td>
						</tr>
						@endforeach

						</tbody>
					</table>
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