<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Condominio;
use App\Models\User;
use App\Models\AgendaTc;
use App\Models\AgendaCat;
use App\Models\Contratista;
use App\Models\Coordinador;
use App\Http\Requests\ContratistaStore;

class ContratistaController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Contratista::class, 'contratista');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratistas = Contratista::where('status', 'active')->get();

        return view('contratistas.index', array(
            'contratistas' => $contratistas
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $condominios = Condominio::all();
        $cats = Coordinador::all();
        return view('contratistas.create', compact('condominios', 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratistaStore $request)
    {
        DB::beginTransaction();

        $user = new User();
        $user->email = $request->correo;
        $user->type = 'contratista';
        $user->password = bcrypt($request->numero_contratista);
        $user->save();

        $agenda_tc = new AgendaTc();
        $agenda_tc = self::agenda_tc($agenda_tc, $request);
        $agenda_tc->save();

        $contratista = new Contratista();
        $contratista = self::contratista($request, $contratista, $user, $agenda_tc);
        $contratista->save();
    
        DB::commit();

        return redirect()->route('contratistas.show', $contratista->id)
                    ->with('message', 'Se ha registrado al contratista correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contratista $contratista)
    {
        return view('contratistas.show', array(
            'contratista' => $contratista
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contratista $contratista)
    {
        $condominios = Condominio::all();
        $cats = Coordinador::all();

        return view('contratistas.edit', array(
            'contratista' => $contratista,
            'condominios'  => $condominios,
            'cats' => $cats,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContratistaStore $request, Contratista $contratista)
    {
        $user = User::findOrFail($contratista->user_id);

        if ($request->correo != $contratista->user->email) {
            $user->email = $request->correo;
            $user->update();
        }

        $agenda_tc = AgendaTc::findOrFail($contratista->agenda_tc_id);
        $agenda_tc = self::agenda_tc($agenda_tc, $request);
        $agenda_tc->update();

        $contratista = self::contratista($request, $contratista, $user, $agenda_tc);
        $contratista->update();

        return redirect()->route('contratistas.show', $contratista->id)
                    ->with('message', 'Se ha actualizado al contratista correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratista $contratista)
    {
        $contratista->status = 'inactive';
        $contratista->save();

        return redirect('/contratistas')
                    ->with('message', 'Se ha eliminado al contratista correctamente');
    }

    private static function contratista($request, $contratista, $user, $agenda_tc)
    {
        $contratista->user_id = $user->id;
        $contratista->desarrollador = $request->desarrollador;
        $contratista->municipio = $request->municipio;
        $contratista->condominio_id = $request->condominio;
        $contratista->numero_contratista = $request->numero_contratista;
        $contratista->empresa = $request->empresa;
        $contratista->nombre = $request->nombre;
        $contratista->telefono = $request->telefono;
        $contratista->fecha_producto_obra = $request->fecha_producto_obra ?? "";
        $contratista->fecha_producto_vivienda = $request->fecha_producto_vivienda ?? "";
        $contratista->cat_id = $request->cat_id;
        $contratista->agenda_tc_id = $agenda_tc->id;

        return $contratista;
    }

    private static function agenda_tc($agenda_tc, $request)
    {
        $agenda_tc->lunes_i = $request->atc_lunes_i;
        $agenda_tc->lunes_t = $request->atc_lunes_t;
        $agenda_tc->martes_i = $request->atc_martes_i;
        $agenda_tc->martes_t = $request->atc_martes_t;
        $agenda_tc->mier_i = $request->atc_miercoles_i;
        $agenda_tc->mier_t = $request->atc_miercoles_t;
        $agenda_tc->jueves_i = $request->atc_jueves_i;
        $agenda_tc->jueves_t = $request->atc_jueves_t;
        $agenda_tc->viernes_i = $request->atc_viernes_i;
        $agenda_tc->viernes_t = $request->atc_viernes_t;
        $agenda_tc->sabado_i = $request->atc_sabado_i;
        $agenda_tc->sabado_t = $request->atc_sabado_t;
        $agenda_tc->domingo_i = $request->atc_domingo_i;
        $agenda_tc->domingo_t = $request->atc_domingo_t;

        return $agenda_tc;
    }

    private static function agenda_cat($agenda_cat, $request)
    {
        $agenda_cat->lunes_i = $request->acat_lunes_i;
        $agenda_cat->lunes_t = $request->acat_lunes_t;
        $agenda_cat->martes_i = $request->acat_martes_i;
        $agenda_cat->martes_t = $request->acat_martes_t;
        $agenda_cat->mier_i = $request->acat_miercoles_i;
        $agenda_cat->mier_t = $request->acat_miercoles_t;
        $agenda_cat->jueves_i = $request->acat_jueves_i;
        $agenda_cat->jueves_t = $request->acat_jueves_t;
        $agenda_cat->viernes_i = $request->acat_viernes_i;
        $agenda_cat->viernes_t = $request->acat_viernes_t;
        $agenda_cat->sabado_i = $request->acat_sabado_i;
        $agenda_cat->sabado_t = $request->acat_sabado_t;
        $agenda_cat->domingo_i = $request->acat_domingo_i;
        $agenda_cat->domingo_t = $request->acat_domingo_t;

        return $agenda_cat;
    }
}
