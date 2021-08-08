<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Manpower;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Http\Requests\RegistrarTrabajo;

class ManpowerController extends Controller
{
    public function registrarTrabajo(RegistrarTrabajo $request, Manpower $manpower)
    {
        $this->authorize('registrarTrabajo', $manpower);
        DB::beginTransaction();

        $manpower->finalizado = $request->finalizado;

        if ($request->finalizado == '1') {
            $manpower->trabajado_desde = $request->trabajado_desde;
            $manpower->trabajado_hasta = $request->trabajado_hasta;
        } else {
            $manpower->trabajado_desde = null;
            $manpower->trabajado_hasta = null;
        }
        $manpower->save();

        $manpower->load('ticket.manpowers');
        $ticket = $manpower->ticket;

        if ($ticket->no_finalizado && $ticket->manpowers->every->finalizado) {
            $ticket->estado = TicketStatus::FINISHED;
            $ticket->save();
        }

        DB::commit();

        return redirect()->route('tickets.show', $manpower->ticket?->id)->with('message', 'Trabajo registrado exitosamente');
    }

    public function destroy(Manpower $manpower)
    {
        $ticket = $manpower->ticket()->firstOrFail();

        $manpower->delete();

        $manpower->load('ticket.manpowers');
        if ($ticket->no_finalizado && $ticket->manpowers->isNotEmpty() && $ticket->manpowers->every->finalizado) {
            $ticket->estado = TicketStatus::FINISHED;
            $ticket->save();
        }

        return redirect()->route('tickets.show', $ticket->id)->with('message', 'Asignacion de contratista eliminada exitosamente');
    }
}
