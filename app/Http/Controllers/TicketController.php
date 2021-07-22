<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Condominio;
use App\Contratista;
use App\Coordinador;
use App\DetalleTicket;
use App\Encuesta;
use App\Falla;
use App\Familia;
use App\Ticket;
use App\Ubicacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PDF;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 'cliente') {
            $tickets = Ticket::where(array(
                ['cliente_id', auth()->user()->cliente->id],
                ['estado', '<>', 'Cancelada'],
            ))->get();

            $encuesta = Ticket::where('cliente_id', auth()->user()->cliente->id)
                ->with(['encuestas' => function ($query) {
                    return $query->where('active', 1);
                }])->get()->last();
            if ($encuesta != null and !$encuesta->encuestas->IsEmpty()) {
                return redirect("/encuesta/" . $encuesta->encuestas->first()->id);
            }
        } elseif (auth()->user()->type == 'contratista') {
            $tickets = Ticket::whereHas('detalle', function (Builder $query) {
                $query->where('contratista_id', auth()->user()->contratista->id);
            })->get();
        } elseif (auth()->user()->type == 'coordinador') {
            $tickets = Ticket::where(array(
                ['estado', '<>', 'Cancelada'],
                ['cat_id', auth()->user()->cat->id],
            ))->get();
        } else {
            $tickets = Ticket::where('estado', '<>', 'Cancelada')->get();
        }

        return view('tickets.index', array(
            'tickets' => $tickets,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familias = Familia::get();
        $clientes = Cliente::get();
        $ubicaciones = Ubicacion::get();
        $condominios = Condominio::get();

        return view('tickets.create', array(
            'familias' => $familias,
            'clientes' => $clientes,
            'ubicaciones' => $ubicaciones,
            'condominios' => $condominios,
        ));
    }

    public function getTicketValues(Request $request)
    {
        $body = $request->input();
        $familia = Familia::where('id', $body['id'])->first();
        return response()->json(array(
            'conceptos' => $familia->conceptos,
            'fallas' => $familia->fallas,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();
        if (auth()->user()->type == 'user') {
            $ticket->cliente_id = $request->Cliente;
        } else {
            $ticket->cliente_id = auth()->user()->cliente->id;
        }
        $ticket->save();

        for ($i = 0; $i < sizeof($request->Falla); $i++) {
            $detalle = new DetalleTicket();
            $detalle->ticket_id = $ticket->id;
            $detalle->familia_id = $request->Familia[$i];
            $detalle->concepto_id = $request->Concepto[$i];
            $detalle->falla_id = $request->Falla[$i];
            $detalle->ubicacion_id = $request->Ubicacion[$i];
            $detalle->save();
        }

        $encuesta = new Encuesta();
        $encuesta->ticket_id = $ticket->id;
        $encuesta->save();

        return view('tickets.success', array(
            'dictamen' => $ticket->id,
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $coordinadores = Coordinador::with('user')->get();
        $contratistas = Contratista::with('user')->get();
        $ubicaciones = Ubicacion::all();
        $clientes = Cliente::all();
        $view = (auth()->user()->type == 'cliente') ? 'tickets.cshow' : 'tickets.show';

        return view($view, array(
            'ticket' => $ticket,
            'cats' => $coordinadores,
            'contratistas' => $contratistas,
            'ubicaciones' => $ubicaciones,
            'clientes' => $clientes,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $contratistas = Contratista::with('user')->get();
        $coordinadores = Coordinador::with('user')->get();
        $fallas = Falla::with('familia')->get();
        $estados = ['Sin visitar' => 'Sin visitar', 'Valorada' => 'Valorada', 'En progreso' => 'En progreso', 'Terminada' => 'Terminada'];
        return view('tickets.edit', array(
            'ticket' => $ticket,
            'contratistas' => $contratistas,
            'coordinadores' => $coordinadores,
            'fallas' => $fallas,
            'estados' => $estados,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = $this->validate($request, [
            "cat_id" => "required|numeric",
            "contratista_id" => "required|numeric",
        ]);
        $ticket->cat_id = $request->cat_id;
        $ticket->contratista_id = $request->contratista_id;
        if ($request->Atencion_cat != '' and $request->Atencion_contratista != '') {
            $ticket->cita_cat = Carbon::createFromFormat('d/m/Y', $request->Atencion_cat)->format('Y-m-d');
            $ticket->cita_contratista = Carbon::createFromFormat('d/m/Y', $request->Atencion_contratista)->format('Y-m-d');
        }
        $ticket->estado = $request->estado;
        $ticket->save();

        return redirect('/tickets')
            ->with('message', 'Se ha actualizado el ticket correctamente');
    }

    public function asignarCat(Request $request)
    {

        $body = $request->input();
        $catSeleccionado = $body['catSeleccionado'];

        if ($catSeleccionado != 'none') {

            $ticket = Ticket::findOrFail($body['id']);
            $ticket->cat_id = $catSeleccionado;
            $ticket->save();

            $mensaje = 'CAT asignado correctamente.';
        } else {
            $mensaje = 'No hay CAT seleccionado.';
        }

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function asignarPrototipo(Request $request)
    {
        $body = $request->input();
        $prototipo = $body['prototipo'];

        if ($prototipo != '') {

            $ticket = Ticket::findOrFail($body['id']);
            $ticket->prototipo = $prototipo;
            $ticket->update();

            $mensaje = 'Prototipo asignado correctamente.';
        } else {
            $mensaje = 'Agregue un prototipo.';
        }

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function asignarCita(Request $request)
    {

        $body = $request->input();
        $cita = $body['cita'];

        if (!is_null($cita)) {

            $ticket = Ticket::findOrFail($body['id']);
            $ticket->cita_cat = Carbon::createFromFormat('d/m/Y', $cita)->format('Y-m-d');
            $ticket->save();

            $mensaje = 'Cita asignada correctamente.';
        } else {
            $mensaje = 'No has seleccionado una fecha para la cita.';
        }

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function asignarCitaAtencion(Request $request)
    {

        $body = $request->input();
        $ticket = Ticket::findOrFail($body['id']);
        $citaAtencion = $body['citaAtencion'];

        if (!is_null($citaAtencion)) {

            $ticket = Ticket::findOrFail($body['id']);
            $field = "cita_atencion_" . $body['numeroCita'];
            $ticket->$field = Carbon::createFromFormat('m/d/Y g:i A', $citaAtencion)->format('Y-m-d H:i');
            $ticket->save();

            $mensaje = 'Cita asignada correctamente.';
        } else {
            $mensaje = 'No has seleccionado una fecha para la cita.';
        }

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    public function asignarFechaReporte(Request $request)
    {
        $body = $request->input();
        $ticket = Ticket::findOrFail($body['id']);
        $fechaReporte = $body['fechaReporte'];

        if (!is_null($fechaReporte)) {

            $ticket = Ticket::findOrFail($body['id']);
            $ticket->created_at = Carbon::createFromFormat('d/m/Y', $fechaReporte)->format('Y-m-d');
            $ticket->save();

            $mensaje = 'Fecha de reporte cambiada correctamente.';
        } else {
            $mensaje = 'No has seleccionado una fecha de reporte del ticket.';
        }

        return response()->json(array(
            'mensaje' => $mensaje,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket = Ticket::findOrFail($ticket->id);
        $ticket->estado = 'Cancelada';
        $ticket->update();

        return redirect('/tickets')
            ->with('message', 'Se ha eliminado el ticket correctamente');
    }

    public function genaratePDF($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        if ($ticket->cita_cat) {
            $ticket->cita_cat = Carbon::createFromFormat('Y-m-d', $ticket->cita_cat)->format('d/m/Y');
        }

        $pdf = PDF::loadView('pdf.dictamen', compact('ticket'));
        return $pdf->download('Dictamen' . $ticket_id . '.pdf');
    }
}
