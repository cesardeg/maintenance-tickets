@extends('general.layout')

@push('styles')
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Condominio {{ $condominio->nombre }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/condominios">
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
				<h3 class="card-title">Datos del condominio</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="Nombre">Nombre</label>
							<input type="text" class="form-control" name="Nombre" value="{{ $condominio->nombre }}" disabled>
						</div>
					</div>
				</div> <!-- /.row -->
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<a href="/condominios/{{ $condominio->id }}/edit">
					<button type="submit" class="btn btn-primary">Editar</button>
				</a>
				<!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Eliminar</button> -->
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-danger">
		<div class="modal-dialog">
			<div class="modal-content bg-danger">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar condominio {{ $condominio->nombre }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Estás seguro que deseas eliminar el condominio {{ $condominio->nombre }}?</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
					<form role="form" action="/condominios/{{ $condominio->id }}" method="post">
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
</script>
@endpush