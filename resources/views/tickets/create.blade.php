@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Registrar nuevo Ticket</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@if (auth()->user()->type == 'user')
					<li class="px-2">
						<button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-default">Seleccionar condominio</button>
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
				<h3 class="card-title">Registrar ticket de falla</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" action="/tickets" method="post">
			{{ csrf_field() }}
			<div class="card-body">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<!-- /.col -->
				@if (auth()->user()->type == 'user')
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Cliente</label>
							<select id="Clientes" class="form-control select2" name="Cliente" style="width: 100%;">
								@foreach ($clientes as $cliente)
								<option value="{{ $cliente->id }}">{{ $cliente->condominio->nombre }} - {{ $cliente->numero_cliente }} / {{ $cliente->nombre }}</option>
								@endforeach
							</select>
						</div>
						<!-- /.form-group -->
					</div>
				</div>
				@endif
				<div class="data" id="data">
					<div class="row" id="master-node" name="master-node">
						<div class="col-sm-3">
							<div class="form-group">
								<label for="Familia[]">Familia</label>
								<select class="form-control-sm" id="Familia" name="Familia[]" style="width: 100%;" onchange="cambiarOpciones(this)">
									@foreach ($familias as $familia)
									<option value="{{ $familia->id }}" {{ old('Familia') == $familia->id ? 'selected' : '' }} >{{ $familia->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="Concepto[]">Concepto</label>
								<select id="Conceptos" class="form-control-sm" name="Concepto[]" style="width: 100%;">
									@foreach ($familias[0]->conceptos as $concepto)
									<option value="{{ $concepto->id }}" {{ old('Conceptos') == $concepto->id ? 'selected' : '' }} >{{ $concepto->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="Falla[]">Falla</label>
								<select id="Fallas" class="form-control-sm" name="Falla[]" style="width: 100%;">
									@foreach ($familias[0]->fallas as $falla)
									<option value="{{ $falla->id }}" {{ old('Falla') == $falla->id ? 'selected' : '' }} >{{ $falla->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="Ubicacion[]">Ubicacion</label>
								<select id="Ubicacion" class="form-control-sm" name="Ubicacion[]" style="width: 100%;">
									@foreach ($ubicaciones as $ubicacion)
									<option value="{{ $ubicacion->id }}" {{ old('Ubicacion') == $ubicacion->id ? 'selected' : '' }} >{{ $ubicacion->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-1" style="align-self: center;">
							<button type="button" onclick="eliminarFalla(this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
						</div>
					</div> <!-- /.row -->
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="button" onclick="agregarFalla()" class="btn btn-primary">Agregar Falla</button>
					<button type="submit" class="btn btn-success" style="float: right;">Registrar</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content bg-default">
				<div class="modal-header">
					<h4 class="modal-title">Selecciona un condominio</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Condominios</label>
							<select id="Condominios" class="form-control select2" name="Condominio" style="width: 100%;">
								@foreach ($condominios as $condominio)
								<option value="{{ $condominio->id }}">{{ $condominio->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="seleccionarCondominio()" data-dismiss="modal">Seleccionar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</section>
@endsection

@push('scripts')
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$('.select2').select2();
</script>
<script type="text/javascript">
function cambiarOpciones(nodo) {
	let parent = nodo.parentElement.parentElement.parentElement;
	let child = parent.childNodes;
	const selectConceptos = child[3].childNodes[1].childNodes[3];
	const selectFallas = child[5].childNodes[1].childNodes[3];

	for (let i = selectConceptos.options.length; i >= 0; i--) { selectConceptos.remove(i); }
	for (let i = selectFallas.options.length; i >= 0; i--) { selectFallas.remove(i); }

	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/tickets/getTicketValues',
		data: { 'id': nodo.value },
		type: 'POST',
		success: (response) => {
			var conceptos = response.conceptos;
			var fallas = response.fallas;

			conceptos.forEach(concepto => {
				const option = document.createElement('option');
				option.value = concepto.id;
				option.text = concepto.nombre;
				selectConceptos.appendChild(option);
			});

			fallas.forEach(falla => {
				const option = document.createElement('option');
				option.value = falla.id;
				option.text = falla.nombre;
				selectFallas.appendChild(option);
			});
		},
		error: (error) => {
			console.log('error', error);
		}
	});
}

function seleccionarCondominio() {
	const selectCondominios = document.querySelector('#Condominios');
	const selectClientes = document.querySelector('#Clientes');

	for (let i = selectClientes.options.length; i >= 0; i--) { selectClientes.remove(i); }

	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
	$.ajax({
		url: '/clientes/getClientes',
		data: { 'condominio_id': selectCondominios.value },
		type: 'POST',
		success: (response) => {
			var clientes = response.clientes;
			clientes.forEach(cliente => {
				const option = document.createElement('option');
				option.value = cliente.id;
				option.text = cliente.nombre_condominio + " - " + cliente.numero_cliente + " / " +  cliente.nombre;
				selectClientes.appendChild(option);
			});
		},
		error: (error) => {
			console.log('error', error);
		}
	});
}

function agregarFalla() {
	let data = document.querySelector("#data");
	let master_node = document.querySelector("#master-node");
	let copy_node = master_node.cloneNode(true);
	data.appendChild(copy_node);
}

function eliminarFalla(nodo) {
	let master_node = document.getElementsByName("master-node");
	if (master_node.length <= 1) {
		toastr.warning('No puedes eliminar esta falla.');
	} else {
		let parent = nodo.parentElement.parentElement;
		parent.remove();
	}
}
</script>
@endpush