<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Condominio;
use App\Models\Contratista;
use App\Models\Coordinador;
use App\Models\DetalleTicket;
use App\Models\Encuesta;
use App\Models\Falla;
use App\Models\Familia;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\Ubicacion;
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
            $qry->whereHas('manpowers', fn($power) => $power->where('manpowers.contratista_id', $user->contratista->id));
        }
        if ($user->es_coordinador) {
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
            $ticket->created_at = $request->created_at;
            $ticket->prototipo = $request->prototipo;
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
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket->load('coordinador', 'detalles', 'detalles.ticket');
        $coordinadores = Coordinador::with('user', 'agenda_cat')->get();
        $contratistas = Contratista::with('user', 'agenda_tc')->get();
        $ubicaciones = Ubicacion::all();
        $clientes = Cliente::all();

        return view('tickets.show', array(
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
     * @param  \App\Models\Ticket  $ticket
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
     * @param  \App\Models\Ticket  $ticket
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('message', 'Ticket eliminado correctamente');
    }

    public function genaratePDF($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        $pdf = PDF::loadView('pdf.dictamen', compact('ticket'));
        return $pdf->stream('Dictamen' . $ticket_id . '.pdf');
    }
}
