@extends('general.layout')

@push('styles')
<link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
<link src="{{ url('/plugins/chart.js/Chart.min.css') }}">
<link rel="stylesheet" href="/assets/custom.css">
@endpush

@section('header')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Estadisticas</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="px-2">
                        <button type="button" class="btn btn-block btn-secondary" onclick="obtenerData()">Generar estadistíca</button>
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
				<h3 class="card-title">Estadistícas de satisfacción</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
                <div class="row form-group">
                    <div class="input-group date col-sm-6" id="fecha_inicio" data-target-input="nearest">
                        <input class="form-control datetimepicker-input" type="text" name="fecha_inicio" data-target="#fecha_inicio" id="fecha_inicio_input" value="{{ old('fecha_inicio', $startDay) }}">
                        <div class="input-group-append" data-target="#fecha_inicio" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="input-group date col-sm-6" id="fecha_fin" data-target-input="nearest">
                        <input class="form-control datetimepicker-input" type="text" name="fecha_fin" data-target="#fecha_fin" id="fecha_fin_input" value="{{ old('fecha_fin', $endDay) }}">
                        <div class="input-group-append" data-target="#fecha_fin" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row height-chart">
                    <canvas id="canvas"></canvas>
                </div>
            <!-- /.card-body -->
            </div>
        </div>
	</div>
</section>
@endsection

@push('scripts')
{{-- SCRIPTS DE CHARTJS --}}
<script src="{{ url('/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ url('/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ url('/plugins/adminlte/js/adminlte.js') }}"></script>
<script src="{{ url('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
	bsCustomFileInput.init();
});
$(function () {
	$('#fecha_inicio').datetimepicker({
		format: 'L',
		locale: 'es'
	});

	$('#fecha_fin').datetimepicker({
		format: 'L',
		locale: 'es'
	});

});
</script>

<script>
    let ctx = document.getElementById('canvas').getContext('2d');
    let datasetChart = [];
    let labelsArray = [];
    generateDataset({!! json_encode($data) !!});

    generateChart();

    function obtenerData() {
        const startDay = document.querySelector('#fecha_inicio_input').value;
        const endDay = document.querySelector('#fecha_fin_input').value;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
        $.ajax({
            url: '/estadistica-satisfaccion/getData',
            data: { 'startDay': startDay, 'endDay': endDay },
            type: 'GET',
            success: (response) => {
                generateDataset(response)
                destroyChart()
                generateChart()
            },
            error: (error) => {
                toastr.error('Ocurrió un error inesperado.')
            }
        });
    }

    function generateDataset(dataObject){
        console.log(dataObject)
        datasetChart = []
        dataArray = [
            dataObject[0].total_1,
            dataObject[0].total_2,
            dataObject[0].total_3,
            dataObject[0].total_4,
            dataObject[0].total_5
        ]
        let dataset = {
            data: dataArray,
            backgroundColor: '#77BBEE',
            borderColor: '#77BBEE',
            borderWidth: 1,
        }
        datasetChart.push(dataset)
    }

    function generateChart(){
        console.log(datasetChart)
        window.chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Facilidad al levantar el ticket de atención de garantía',
                    'Puntualidad de los colaboradores',
                    'Experiencia de valoración',
                    'Experiencia de solución de la falla',
                    'Calificación del servicio obtenido'
                ],
                datasets: datasetChart
            },
            options: {
                tooltips:{
                    enabled: false
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            min: 0,
                            max: 10
                        }
                    }]
                },
                maintainAspectRatio: false
            }
        });
    }

    function destroyChart(){
        window.chart.destroy();
    }
</script>
@endpush