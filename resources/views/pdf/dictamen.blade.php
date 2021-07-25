<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>DICTAMEN TECNICO PARA  REPORTE DE GARANTIAS</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="/plugins/adminlte/css/adminlte.css"> --}}
    <link rel="stylesheet" href="/assets/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: .65rem
        }
    </style>
</head>
<body>
    <img src="{{ public_path('/assets/img/doc-logo.jpg') }}" alt="page logo" width="140px" style="position: absolute; top: 0px; left: 12px;">
    <br>
    <br>
    <div>
        <div class="row">
            <div class="col text-center">
                <span>DICTAMEN TECNICO PARA  REPORTE DE GARANTIAS</span>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                Dictamen No. {{ $ticket->id }}
            </div>
        </div>
        <table class="table">
            <tr>
                <td>
                    DESARROLLO: <br> {{ $ticket->cliente->desarrollador }}
                </td>
                <td>
                    CLIENTE: <br> {{ $ticket->cliente->nombre }}
                </td>
                <td>
                    DOMICILIO: <br> {{ $ticket->cliente->condominio->nombre }} {{ $ticket->cliente->numero_cliente }}
                </td>
            </tr>
            <tr>
                <td>
                    FECHA REPORTE: <br> {{ date('d/m/y h:i A', strtotime($ticket->created_at)) }}
                </td>
                <td>
                    FECHA DE VISITA DE CAT: <br> {{ $ticket->cita_cat }}
                </td>
                <td>
                    FECHA POLIZA: <br> {{ $ticket->cliente->fecha_poliza }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    FECHAS PROGRAMADAS DE ATENCIÓN: <br> {{ is_null($ticket->cita_atencion_1) ? "" : date('d/m/y h:i A', strtotime($ticket->cita_atencion_1)) }}{{ is_null($ticket->cita_atencion_2) ? "" : ", " .  date('d/m/y h:i A', strtotime($ticket->cita_atencion_2)) }}{{ is_null($ticket->cita_atencion_3) ? "" : ", " . date('d/m/y h:i A', strtotime($ticket->cita_atencion_3)) }}
                </td>
                <td>
                    PROTOTIPO: <br> {{ $ticket->prototipo }}
                </td>
            </tr>

            @foreach ($ticket->detalles as $key => $detalle)
                <tr>
                    <td colspan="3" class="text-center">
                        FALLA NO.{{ $key + 1 }}
                    </td>
                </tr>
                <tr>
                    <td>
                        FAMILIA: <br> {{ $detalle->familia->nombre}}
                    </td>
                    <td>
                        COMPONENTES: <br> {{ $detalle->concepto->nombre}}
                    </td>
                    <td>
                        Tipo de falla: <br> {{ $detalle->falla->nombre}}
                    </td>
                </tr>
                <tr>
                    <td>
                        UBICACIÓN: <br> {{ $detalle->ubicacion_id != null  ? $detalle->ubicacion->nombre : 'Sin ubicacion' }}
                    </td>
                    <td>
                        CONTRATISTA: <br> {{ $detalle->contratista_id != null ? $detalle->contratista->nombre : 'Sin asignar'}}
                    </td>
                    <td>
                        PROCEDE: <br> {{ $detalle->valoracion}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        OBSERVACIONES <br> {{ $detalle->observacion }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="mt-5">
                    ______________________________
                    <br>
                    NOMBRE Y FIRMA DE EL CLIENTE
                </td>
                <td colspan="2" class="mt-5">
                    __________________________________
                    <br>
                    NOMBRE Y FIRMA DE TECNICO TRAZO
                </td>
            </tr>
        </table>
    </div>
</body>
</html>