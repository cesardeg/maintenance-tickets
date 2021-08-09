@extends('general.layout')
@push('styles')
<link rel="stylesheet" href="{{ url('/assets/custom.css') }}">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Encuesta del dictamen # {{ $encuesta->id }}</h1>
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
                <h3 class="card-tittle">
                    Encuesta
                </h3>
            </div>
            <form role="form" action="{{ route('encuestas.contestar', $encuesta->id) }}" method="post">
                <input type="hidden" name="encuesta_id" value="{{ $encuesta->id }}">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row d-flex align-items-center justify-content-between py-2">
                            <div>
                                ¿Del 1 al 10 qué tan fácil fue levantar el ticket de su atención de garantía?
                            </div>
                            <div>
                                <input class="form-control text-center" type="number" name="pregunta_1" id="pregunta_1" min="1" max="10" @if($encuesta->active) value="{{ $encuesta->pregunta_1 }}" disabled @endif required>
                            </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-between py-2">
                            <div>
                                ¿Del 1 al 10 cómo fue la puntualidad de los colaboradores que le atendieron?
                            </div>
                            <div>
                                <input class="form-control text-center" type="number" name="pregunta_2" id="pregunta_2" min="1" max="10" @if($encuesta->active) value="{{ $encuesta->pregunta_2 }}" disabled @endif required>
                            </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-between py-2">
                            <div>
                                ¿Del 1 al 10 cómo fue la experiencia de valoración de su garantía?
                            </div>
                            <div>
                                <input class="form-control text-center" type="number" name="pregunta_3" id="pregunta_3" min="1" max="10" @if($encuesta->active) value="{{ $encuesta->pregunta_3 }}" disabled @endif required>
                            </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-between py-2">
                            <div>
                                ¿Del 1 al 10 Cómo fue su experiencia para la solución de la falla del producto?
                            </div>
                            <div>
                                <input class="form-control text-center" type="number" name="pregunta_4" id="pregunta_4" min="1" max="10" @if($encuesta->active) value="{{ $encuesta->pregunta_4 }}" disabled @endif required>
                            </div>
                    </div>
                    <div class="row d-flex align-items-center justify-content-between py-2">
                            <div>
                                ¿Del 1 al 10 cómo calificaría el servicio ofrecido por el departamento de atención al cliente?
                            </div>
                            <div>
                                <input class="form-control text-center" type="number" name="pregunta_5" id="pregunta_5" min="1" max="10" @if($encuesta->active) value="{{ $encuesta->pregunta_5 }}" disabled @endif required>
                            </div>
                    </div>
                    @if (!$encuesta->active)
                    <div class="row d-flex">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
@endsection