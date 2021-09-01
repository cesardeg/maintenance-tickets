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
                    PROTOTIPO: <br> {{ $ticket->prototipo ?? 'N/D' }}
                </td>
                <td>
                    FECHA REPORTE: <br> {{ $ticket->created_at?->format('d/m/Y H:i') }}
                </td>
                <td>
                    FECHA POLIZA: <br> {{ $ticket->cliente->fecha_poliza?->format('d/m/Y') }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    COORDINADOR DE ATENCIÓN TÉCNICA (CAT): <br> {{ $ticket->coordinador?->nombre ?? 'Pendiente de asignación' }}
                </td>
                <td>
                    FECHA VISITA CAT: <br> {{ $ticket->cita_cat?->format('d/m/Y H:i') ?? 'N/D' }}
                </td>
            </tr>

            @foreach ($ticket->detalles as $key => $detalle)
            @if($contratista_id == null || $detalle->manpowers->map->contratista_id->contains($contratista_id))
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
                        COMPONENTES: <br> {{ $detalle->concepto?->nombre}}
                    </td>
                    <td>
                        TIPO DE FALA: <br> {{ $detalle->falla?->nombre ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td>
                        UBICACIÓN: <br> {{ $detalle->ubicacion?->nombre }}
                    </td>

                    <td>
                        PROCEDE: <br> {{ $detalle->valoracion }}
                    </td>
                    <td>
                        OBSERVACIONES <br> {{ $detalle->observacion ?? 'N/D' }}
                    </td>
                </tr>
                @foreach($detalle->manpowers as $manpower)
                @if($contratista_id == null || $manpower->contratista_id == $contratista_id)
                <tr>
                    <td>
                        CONTRATISTA: <br> {{ $manpower->contratista?->nombre }}
                    </td>

                    <td>
                        FECHA DE TRABAJO PROGRAMADA: <br> {{ $manpower->agendado_desde?->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        FECHA DE ATENCIÓN: <br> {{ $manpower->trabajado_desde?->format('d/m/Y H:i') ?? 'N/D' }}
                    </td>
                </tr>
                @endif
                @endforeach
            @endif
            @endforeach
            <tr>
                <td colspan="2" class="mt-5">
                    ______________________________________
                    <br>
                    NOMBRE Y FIRMA DEL CLIENTE
                </td>
                <td colspan="2" class="mt-5">
                    ______________________________________
                    <br>
                    NOMBRE Y FIRMA DEL CONTRATISTA
                </td>
            </tr>
        </table>
    </div>
</body>
</html>