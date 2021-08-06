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
use App\TicketStatus;
use App\Ubicacion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\TicketStore;
use App\Http\Requests\TicketCoordinadorUpdate;
use PDF;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $qry = Ticket::with('condominio', 'cliente')->latest();

        if ($user->es_cliente) {
            $qry->where('cliente_id', $user->cliente->id);
        }
        if ($user->es_contratista) {
            $qry->whereHas('detalles', fn($detalle) => $detalle->where('contratista_id', $user->contratista->id));
        }
        if ($user->es_cat) {
            $qry->where('cat_id', $user->cat->id);
        }
        if ($request->buscar) {
            $qry->buscar($request->buscar);
        }
        if ($request->estado !== null) {
            $qry->where('estado', $request->estado);
        }
        if ($request->condominio_id) {
            $qry->where('condominio_id', $request->condominio_id);
        }
        $tickets = $qry->paginate()->appends($request->all());
        $condominios = Condominio::all();
        $estados = TicketStatus::toArray();

        return view('tickets.index', compact(
            'tickets', 'condominios', 'estados'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $condominios = Condominio::get();
        $clientes = old('condominio_id')
            ? Cliente::where('condominio_id', old('condominio_id'))->get()
            : [];
        $ubicaciones = Ubicacion::get();
        $familias = Familia::with('conceptos', 'fallas')->get()->keyBy('id');

        return view('tickets.create', array(
            'familias' => $familias,
            'clientes' => $clientes,
            'ubicaciones' => $ubicaciones,
            'condominios' => $condominios,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TicketStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStore $request)
    {
        $ticket = new Ticket();
        if ($cliente = auth()->user()->cliente) {
            $ticket->cliente_id = $cliente->id;
            $ticket->condominio_id = $cliente->condominio_id;
        } else {
            $ticket->condominio_id = $request->condominio_id;
            $ticket->cliente_id = $request->cliente_id;
        }
        $ticket->save();

        $ticket->detalles()->saveMany(array_map(function($data) {
            $detalle = new DetalleTicket();
            $detalle->familia_id = $data['familia_id'];
            $detalle->concepto_id = $data['concepto_id'];
            $detalle->falla_id = $data['falla_id'];
            $detalle->ubicacion_id = $data['ubicacion_id'];
            return $detalle;
        }, $request->detalles));

        $ticket->encuestas()->saveMany([new Encuesta()]);

        return redirect()->route('tickets.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('coordinador', 'detalles', 'detalles.ticket');
        $coordinadores = Coordinador::with('user', 'agenda_cat')->get();
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

    public function asignarCat(TicketCoordinadorUpdate $request, Ticket $ticket)
    {
        $this->authorize('asignarCat', $ticket);
        $ticket->cat_id = $request->cat_id;
        $ticket->cita_cat = $request->cita_cat;
        $ticket->cita_cat_fin = $request->cita_cat_fin;
        if ($ticket->estado < TicketStatus::APPRAISING) {
            $ticket->estado = TicketStatus::APPRAISING;
        }
        $ticket->save();
        return redirect()->route('tickets.show', $ticket->id)->with('message', 'Coordinador asignado correctamente!');
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
