<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Encuesta;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Http\Requests\EncuestaStore;

class EncuestaController extends Controller
{
    public function store(EncuestaStore $request, Encuesta $encuesta)
    {
        $this->authorize('contestar', $encuesta);
        $ticket = Ticket::findOrFail($encuesta->ticket_id);

        DB::beginTransaction();

        $encuesta->pregunta_1 = $request->pregunta_1;
        $encuesta->pregunta_2 = $request->pregunta_2;
        $encuesta->pregunta_3 = $request->pregunta_3;
        $encuesta->pregunta_4 = $request->pregunta_4;
        $encuesta->pregunta_5 = $request->pregunta_5;
        $encuesta->active = true;
        $encuesta->save();

        $ticket->estado = TicketStatus::RATED;
        $ticket->save();

        DB::commit();

        return redirect()
            ->route('tickets.show', $encuesta->ticket_id)
            ->with('message', 'Se ha registrado la encuesta correctamente');
    }

    public function show(Encuesta $encuesta)
    {
        $this->authorize('view', $encuesta);

        return view('encuesta.show', array(
            'encuesta' => $encuesta,
        ));
    }
}
