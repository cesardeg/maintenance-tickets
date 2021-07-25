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
                    <li class="px-2">
                        <a href="/tickets">
                            <button type="button" class="btn btn-block btn-secondary">Cancelar</button>
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
                @unless (auth()->user()->es_cliente)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Condominio</label>
                            <select id="condominio" class="form-control" name="condominio_id" onchange="cambiarClientes(this)">
                                <option value="" selected>Selecciona condiminio</option>
                                @foreach ($condominios as $condominio)
                                <option value="{{ $condominio->id }}" @if(old('condominio_id') == $condominio['id']) selected @endif  }}>
                                    {{ $condominio->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select id="cliente" class="form-control select2 w-100" name="cliente_id">
                                <option value="">Selecciona cliente</option>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" @if(old('cliente_id') == $cliente['id']) selected @endif>
                                    {{ $cliente->numero_cliente . ' - ' . $cliente->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                @endunless
                <div class="data" id="detalles">
                    @foreach(old('detalles', [[]]) as $i => $detalle)
                    <div class="row mb-3 border-bottom pb-3" id="detalle-{{ $i }}">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="familia-{{ $i }}">Familia</label>
                                <select id="familia-{{ $i }}" class="form-control" name="detalles[{{ $i }}][familia_id]" onchange="cambiarOpciones(this, {{ $i }})">
                                    <option value="">Selecciona familia</option>
                                    @foreach ($familias as $familia)
                                    <option value="{{ $familia->id }}" @if(Arr::get($detalle, 'familia_id') == $familia['id']) selected @endif>
                                        {{ $familia->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="concepto-{{ $i }}">Concepto</label>
                                <select id="concepto-{{ $i }}" class="form-control" name="detalles[{{ $i }}][concepto_id]">
                                    <option value="">Selecciona concepto</option>
                                    @if(Arr::get($detalle, 'familia_id'))
                                        @foreach ($familias[Arr::get($detalle, 'familia_id')]->conceptos as $concepto)
                                        <option value="{{ $concepto->id }}" @if(Arr::get($detalle, 'concepto_id') == $concepto['id']) selected @endif>
                                            {{ $concepto->nombre }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="falla-{{ $i }}">Falla</label>
                                <select id="falla-{{ $i }}" class="form-control" name="detalles[{{ $i }}][falla_id]">
                                    <option value="">Selecciona Falla</option>
                                    @if(Arr::get($detalle, 'familia_id'))
                                        @foreach ($familias[Arr::get($detalle, 'familia_id')]->fallas as $falla)
                                        <option value="{{ $falla->id }}" @if(Arr::get($detalle, 'falla_id') == $falla['id']) selected @endif>
                                            {{ $falla->nombre }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ubicacion-{{ $i }}">Ubicación</label>
                                <select id="ubicacion-{{ $i }}" class="form-control" name="detalles[{{ $i }}][ubicacion_id]">
                                    <option value="">Selecciona Ubicación</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" @if(Arr::get($detalle, 'ubicacion_id') == $ubicacion['id']) selected @endif>
                                        {{ $ubicacion->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 text-right">
                            @unless ($i == 0)
                            <button type="button" onclick="eliminarFalla(this)" class="btn btn-danger">
                                Eliminar falla
                            </button>
                            @endunless
                        </div>
                    </div> <!-- /.row -->
                    @endforeach
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" onclick="agregarFalla()" class="btn btn-info">Agregar Falla</button>
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>
                </div>
            </form>
        </div>
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
const familias = @json($familias);
const ubicaciones = @json($ubicaciones);

function cambiarClientes(element) {
    const selectClientes = $('#cliente');
    selectClientes.children('option:gt(0)').remove();

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
    $.ajax({
        url: '/clientes/getClientes',
        data: { 'condominio_id': element.value },
        type: 'POST',
        success: (response) => {
            var clientes = response.clientes;
            selectClientes.append(
                clientes.map((cliente) => $('<option />', { value: cliente.id }).text(cliente.numero_cliente + " - " +  cliente.nombre))
            );
        },
        error: (error) => {
            console.log('error', error);
        }
    });
}

function cambiarOpciones(nodo, index) {
    const selectConceptos = $('#concepto-' + index);
    const selectFallas = $('#falla-' + index);
    selectConceptos.children('option:gt(0)').remove();
    selectFallas.children('option:gt(0)').remove();

    const familia = familias[nodo.value];
    if (!familia) {
        return;
    }

    selectConceptos.append(
        familia.conceptos.map((concepto) => $('<option />', { value: concepto.id }).text(concepto.nombre))
    );
    selectFallas.append(
        familia.fallas.map((falla) => $('<option />', { value: falla.id }).text(falla.nombre))
    );
}

function agregarFalla() {
    let list = $("#detalles");
    let index = new Date().getTime();
    let node = $('<div />', {'class': 'row mb-3 pb-3 border-bottom', id: 'detalle-' + index}).append([
        $('<div />', {'class': 'col-sm-3'}).append(
            $('<div />', {'class': 'form-group'}).append([
                $('<label />', {for: 'familia-' + index}).text('Familia'),
                $('<select />', {
                    id: 'familia-' + index,
                    'class': 'form-control',
                    name: 'detalles[' + index + '][familia_id]',
                    onchange: 'cambiarOpciones(this, ' + index +')',
                }).append([
                    $('<option />', {value: '', selected: true}).text('Selecciona familia')
                ].concat(
                    Object.values(familias).map((familia) => $('<option />', {
                        value: familia.id,
                    }).text(familia.nombre))
                ))
            ])
        ),
        $('<div />', {'class': 'col-sm-3'}).append(
            $('<div />', {'class': 'form-group'}).append([
                $('<label />', {for: 'concepto-' + index}).text('Concepto'),
                $('<select />', {
                    id: 'concepto-' + index,
                    'class': 'form-control',
                    name: 'detalles[' + index + '][concepto_id]',
                }).append([
                    $('<option />', {value: '', selected: true}).text('Selecciona concepto')
                ])
            ])
        ),
        $('<div />', {'class': 'col-sm-3'}).append(
            $('<div />', {'class': 'form-group'}).append([
                $('<label />', {for: 'falla-' + index}).text('Falla'),
                $('<select />', {
                    id: 'falla-' + index,
                    'class': 'form-control',
                    name: 'detalles[' + index + '][falla_id]',
                }).append([
                    $('<option />', {value: '', selected: true}).text('Selecciona Falla')
                ])
            ])
        ),
        $('<div />', {'class': 'col-sm-3'}).append(
            $('<div />', {'class': 'form-group'}).append([
                $('<label />', {for: 'ubicacion-' + index}).text('Ubicación'),
                $('<select />', {
                    id: 'ubicacion-' + index,
                    'class': 'form-control',
                    name: 'detalles[' + index + '][ubicacion_id]',
                }).append([
                    $('<option />', {value: '', selected: true}).text('Selecciona Ubicación')
                ].concat(
                    ubicaciones.map((ubicacion) => $('<option />', {
                        value: ubicacion.id,
                    }).text(ubicacion.nombre))
                ))
            ])
        ),
        $('<div />', {'class': 'col-sm-12 text-right'}).append(
            $('<button />', { 'class': 'btn btn-danger',  type: 'button', onclick: 'eliminarFalla(this)' }).text('Eliminar falla')
        ),
    ]);
    list.append(node);
}

function eliminarFalla(nodo) {
    $(nodo).closest('.row').remove();
}
</script>
@endpush