<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleTicket;
use App\Models\Encuesta;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\Manpower;
use App\Http\Requests\DetalleValorar;
use App\Http\Requests\DetalleContratista;

class DetalleTicketController extends Controller
{
    public function valorar(DetalleValorar $request, DetalleTicket $detalle)
    {
        $this->authorize('valorar', $detalle);
        $detalle->valoracion = $request->valoracion;
        $detalle->observacion = $request->observacion;
        $detalle->save();

        $ticket = $detalle->ticket;
        if ($ticket->no_finalizado) {
            $ticket->load('detalles');
            $detalles = $ticket->detalles;
            if ($detalles->some->pending_valoration) {
                $ticket->estado = TicketStatus::APPRAISING;
            } elseif ($detalles->some->accepted_valoration) {
                $ticket->estado = TicketStatus::IN_PROGRESS;
            } else {
                $ticket->estado = TicketStatus::NOT_APPLICABLE;
            }
            $ticket->save();
        }

        return redirect()->route('tickets.show', $ticket->id)->with('message', 'Falla valorada exitosamente');
    }

    public function asignarContratista(DetalleContratista $request, DetalleTicket $detalle)
    {
        $this->authorize('asignarContratista', $detalle);
        $ticket = $detalle->ticket;
        $asignacion = new Manpower();
        $asignacion->contratista_id = $request->contratista_id;
        $asignacion->agendado_desde = $request->agendado_desde;
        $asignacion->agendado_hasta = $request->agendado_hasta;

        $detalle->manpowers()->save($asignacion);

        return redirect()->route('tickets.show', $ticket->id)->with('message', 'Contratista asignado exitosamente');
    }
}
