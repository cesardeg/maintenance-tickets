<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

        $ticket = $manpower->ticket()->firstOrFail();
        $manpower->finalizado = $request->finalizado;

        if ($request->finalizado == '1') {
            $manpower->trabajado_desde = Carbon::create($request->trabajado_desde);
            $manpower->trabajado_hasta = Carbon::create($request->trabajado_hasta);
        } else {
            $manpower->trabajado_desde = null;
            $manpower->trabajado_hasta = null;
        }
        $manpower->save();

        DB::commit();

        return redirect()->route('tickets.show', $manpower->ticket?->id)->with('message', 'Trabajo registrado exitosamente');
    }

    public function destroy(Manpower $manpower)
    {
        $ticket = $manpower->ticket()->firstOrFail();

        $manpower->delete();

        return redirect()->route('tickets.show', $ticket->id)->with('message', 'Asignacion de contratista eliminada exitosamente');
    }
}
