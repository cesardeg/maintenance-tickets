<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Condominio;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClienteStore;

class ClienteController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Cliente::class, 'cliente');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $condominios = $user->condominios;

        $qry = Cliente::with('condominio', 'user')->where('status', 'active')->latest();
        if ($request->buscar) {
            $qry->buscar($request->buscar);
        }
        if ($request->condominio_id) {
            $qry->where('clientes.condominio_id', $request->condominio_id);
        } else {
            $qry->whereIn('clientes.condominio_id', $condominios->map->id);
        }
        $clientes = $qry->paginate()->appends($request->all());

        return view('clientes.index', array(
            'clientes' => $clientes,
            'condominios' => $condominios,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $condominios = $user->condominios;

        return view('clientes.create', array(
            'condominios' =>  $condominios
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStore $request)
    {
        DB::beginTransaction();

        $user = new User();
        $user->email = $request->Correo;
        $user->type = 'cliente';
        $user->password = bcrypt($request->Numero_cliente);
        $user->save();

        $cliente = new Cliente();
        $cliente->user_id = $user->id;
        $cliente->desarrollador = $request->Desarrollador;
        $cliente->municipio = $request->Municipio;
        $cliente->condominio_id = $request->Condominio;
        $cliente->numero_cliente = $request->Numero_cliente;
        $cliente->nombre = $request->Nombre_completo;
        $cliente->coopropietario = $request->Coopropietario;
        $cliente->telefono = $request->Telefono;
        $cliente->fecha_escrituracion = $request->Fecha_escrituracion;
        $cliente->fecha_poliza = $request->Fecha_poliza;
        $cliente->fecha_entrega = $request->Fecha_entrega;
        $cliente->comentarios = $request->Comentarios;
        $cliente->save();

        DB::commit();

        return redirect()->route('clientes.show', $cliente->id)
                    ->with('message', 'Se ha registrado al cliente correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $tickets = Ticket::where(array(
            ['cliente_id', $cliente->id],
            ['estado', '<>', 'cancelada'],
        ))->get();

        return view('clientes.show', array(
            'cliente' => $cliente,
            'tickets' => $tickets
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $user = auth()->user();
        $condominios = $user->condominios;

        return view('clientes.edit', array(
            'cliente' => $cliente,
            'condominios' =>  $condominios
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteStore $request, Cliente $cliente)
    {
        DB::beginTransaction();

        $user = $cliente->user()->firstOrFail();

        if ($request->Correo != $user->email) {
            $user = User::findOrFail($cliente->user_id);
            $user->email = $request->Correo;
            $user->save();
        }

        $cliente->desarrollador = $request->Desarrollador;
        $cliente->municipio = $request->Municipio;
        $cliente->condominio_id = $request->Condominio;
        $cliente->numero_cliente = $request->Numero_cliente;
        $cliente->nombre = $request->Nombre_completo;
        $cliente->coopropietario = $request->Coopropietario;
        $cliente->telefono = $request->Telefono;
        $cliente->fecha_escrituracion = $request->Fecha_escrituracion;
        $cliente->fecha_poliza = $request->Fecha_poliza;
        $cliente->fecha_entrega = $request->Fecha_entrega;
        $cliente->comentarios = $request->Comentarios;
        $cliente->save();

        DB::commit();

        return redirect()->route('clientes.show', $cliente->id)
                ->with('message', 'Se ha actualizado al cliente correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->status = 'inactive';
        $cliente->save();

        return redirect('/clientes')
                    ->with('message', 'Se ha eliminado al cliente correctamente');
    }

    public function getClientes(Request $request)
    {
        $body = $request->input();

        $clientes = Cliente::where(array(
            ['status', 'active'],
            ['condominio_id', $body['condominio_id']]
        ))->get();

        foreach ($clientes as $cliente) { $cliente->nombre_condominio = $cliente->condominio->nombre; }

        return response()->json(array(
            'clientes' => $clientes
        ));
    }
}
