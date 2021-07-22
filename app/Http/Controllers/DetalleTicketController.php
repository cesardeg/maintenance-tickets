<?php

namespace App\Http\Controllers;

use App\DetalleTicket;
use App\Encuesta;
use App\Ticket;
use Illuminate\Http\Request;

class DetalleTicketController extends Controller
{

    private function checkStatus($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        $detalles = DetalleTicket::where('ticket_id', $ticket->id)->get();
        $flag = false;
        $finished = 0;

        for ($i = 0; $i < sizeof($detalles); $i++) {
            if ($detalles[$i]->valoracion != 'Pendiente' && $flag != 'En progreso') {$flag = 'Valorada';}
            if ($detalles[$i]->estado == 'Terminada') {$finished++;}
            if ($detalles[$i]->estado == 'En proceso') {$flag = 'En progreso';
                break;}
            if ($finished == sizeof($detalles)) {$flag = 'Terminada';
                break;}
        }

        if (!$flag) {$flag = 'Sin visitar';}

        $ticket->estado = $flag;
        if ($flag == 'Valorada') {$ticket->fecha_visita = is_null($ticket->fecha_visita) ? date('Y-m-d h:i:s') : $ticket->fecha_visita;}
        if ($flag == 'Terminada') {
            $ticket->fecha_finalizado = is_null($ticket->fecha_finalizado) ? date('Y-m-d h:i:s') : $ticket->fecha_finalizado;
            $encuesta = Encuesta::findOrFail($ticket->id);
            $encuesta->active = true;
            $encuesta->update();
        }
        $ticket->update();
    }

    public function asignarContratista(Request $request)
    {
        $body = $request->input();
        $contSeleccionado = $body['contSeleccionado'];

        $detalleTicket = DetalleTicket::findOrFail($body['id']);
        if ($contSeleccionado != 'none') {
            $detalleTicket->contratista_id = $contSeleccionado;
        } else {
            $detalleTicket->contratista_id = null;
        }
        $detalleTicket->save();

        $mensaje = 'Contratista asignado correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function detalle(Request $request)
    {
        $body = $request->input();

        $detalle = DetalleTicket::findOrFail($body['id']);
        return response()->json(array(
            'detalle' => $detalle,
        ));
    }

    public function asignarObservacion(Request $request)
    {
        $body = $request->input();
        $observacion = $body['observacion'];

        $detalleTicket = DetalleTicket::findOrFail($body['id']);
        $detalleTicket->observacion = $observacion;
        $detalleTicket->save();
        $mensaje = 'Observación cambiada correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function asignarUbicacion(Request $request)
    {
        $body = $request->input();
        $ubicacion = $body['ubicacion'] == 0 ? null : $body['ubicacion'];

        $detalleTicket = DetalleTicket::findOrFail($body['id']);
        $detalleTicket->ubicacion_id = $ubicacion;
        $detalleTicket->save();
        $mensaje = 'Ubicacion cambiada correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function cambiarEstado(Request $request)
    {
        $body = $request->input();
        $estado = $body['estado'];

        $detalleTicket = DetalleTicket::findOrFail($body['id']);
        $detalleTicket->estado = $estado;
        $detalleTicket->save();

        $this->checkStatus($detalleTicket->ticket->id);

        $mensaje = 'Estado cambiado correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function cambiarValoracion(Request $request)
    {
        $body = $request->input();
        $valoracion = $body['valoracion'];

        $detalleTicket = DetalleTicket::findOrFail($body['id']);
        $detalleTicket->valoracion = $valoracion;
        if ($valoracion == 'No') {$detalleTicket->estado = 'Terminada';}
        $detalleTicket->save();

        $this->checkStatus($detalleTicket->ticket->id);

        $mensaje = 'Valoración cambiado correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function cambiarCliente(Request $request)
    {
        $body = $request->input();
        $cliente = $body['cliente'];

        $ticket = Ticket::findOrFail($body['id']);
        $ticket->cliente_id = $cliente;
        $ticket->save();
        $mensaje = 'Valoración cambiado correctamente.';

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }
}
