<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\AgendaTc;
use App\AgendaCat;
use App\Contratista;

class ContratistaController extends Controller
{
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
        return view('contratistas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            "Desarrollador" => "required|string",
            "Municipio" => "required|string",
            "Proyecto" => "required|string",
            "Numero_contratista" => "required|integer",
            "Empresa_contratista" => "required|string",
            "Nombre_responsable" => "required|string",
            "Correo" => "email|required|string",
            "Telefono" => "required|numeric",
            "Fecha_producto_a_obra" => "required|string",
            "Fecha_producto_a_vivienda" => "required|string",
            "Cat_asignado" => "required|string"
        ]);

        $emailExist = User::where('email', $request->Correo)->first();
        if ($emailExist) {
            return back()->withErrors(['Esta cuenta de correo ya fue registrada'])
                ->withInput(request(['Desarrollador', 'Municipio', 'Proyecto', 'Numero_contratista', 'Empresa_contratista', 'Nombre_responsable', 'Correo', 'Telefono', 'Fecha_producto_a_obra', 'Fecha_producto_a_vivienda', 'Cat_asignado']));
        }

        DB::transaction(function () use ($request) {
            $user = new User();
            $user->email = $request->Correo;
            $user->type = 'contratista';
            $user->password = bcrypt($request->Numero_contratista);
            $user->save();

            $agenda_tc = new AgendaTc();
            $agenda_tc = self::agenda_tc($agenda_tc, $request);
            $agenda_tc->save();

            $agenda_cat = new AgendaCat();
            $agenda_cat = self::agenda_cat($agenda_cat, $request);
            $agenda_cat->save();

            $contratista = new Contratista();
            $contratista = self::contratista($contratista, $user, $agenda_tc, $agenda_cat, $request);
            $contratista->save();
        });

        return redirect('/contratistas')
                    ->with('message', 'Se ha registrado al contratista correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contratista = Contratista::findOrFail($id);
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
    public function edit($id)
    {
        $contratista = Contratista::findOrFail($id);
        return view('contratistas.edit', array(
            'contratista' => $contratista
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contratista = Contratista::findOrFail($id);
        $user = User::findOrFail($contratista->user_id);

        $validator = $this->validate($request, [
            "Desarrollador" => "required|string",
            "Municipio" => "required|string",
            "Proyecto" => "required|string",
            "Numero_contratista" => "required|integer",
            "Empresa_contratista" => "required|string",
            "Nombre_responsable" => "required|string",
            "Correo" => "email|required|string",
            "Telefono" => "required|numeric",
            "Fecha_producto_a_obra" => "required|string",
            "Fecha_producto_a_vivienda" => "required|string",
            "Cat_asignado" => "required|string"
        ]);

        if ($request->Correo != $contratista->user->email) {
            $emailExist = User::where('email', $request->Correo)->first();
            if ($emailExist) {
                return back()->withErrors(['Esta cuenta de correo ya fue registrada'])
                    ->withInput(request(['Desarrollador', 'Municipio', 'Proyecto', 'Numero_contratista', 'Empresa_contratista', 'Nombre_responsable', 'Correo', 'Telefono', 'Fecha_producto_a_obra', 'Fecha_producto_a_vivienda', 'Cat_asignado']));
            } else {
                $user->email = $request->Correo;
                $user->update();
            }
        }

        $agenda_tc = AgendaTc::findOrFail($contratista->agenda_tc_id);
        $agenda_tc = self::agenda_tc($agenda_tc, $request);
        $agenda_tc->update();

        $agenda_cat = AgendaCat::findOrFail($contratista->agenda_cat_id);
        $agenda_cat = self::agenda_cat($agenda_cat, $request);
        $agenda_cat->update();

        $contratista = self::contratista($contratista, $user, $agenda_tc, $agenda_cat, $request);
        $contratista->update();

        return redirect('/contratistas')
                    ->with('message', 'Se ha actualizado al contratista correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratista = Contratista::findOrFail($id);
        $contratista->status = 'inactive';
        $contratista->save();

        return redirect('/contratistas')
                    ->with('message', 'Se ha eliminado al contratista correctamente');
    }

    private static function contratista($contratista, $user, $agenda_tc, $agenda_cat, $request)
    {
        $contratista->user_id = $user->id;
        $contratista->desarrollador = $request->Desarrollador;
        $contratista->municipio = $request->Municipio;
        $contratista->proyecto = $request->Proyecto;
        $contratista->numero_contratista = $request->Numero_contratista;
        $contratista->empresa = $request->Empresa_contratista;
        $contratista->nombre = $request->Nombre_responsable;
        $contratista->telefono = $request->Telefono;
        $contratista->fecha_producto_obra = $request->Fecha_producto_a_obra;
        $contratista->fecha_producto_vivienda = $request->Fecha_producto_a_vivienda;
        $contratista->coordinador = $request->Cat_asignado;
        $contratista->agenda_tc_id = $agenda_tc->id;
        $contratista->agenda_cat_id = $agenda_cat->id;

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
