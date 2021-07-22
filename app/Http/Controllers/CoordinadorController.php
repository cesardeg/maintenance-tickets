<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordinador;
use App\AgendaCat;
use App\User;
use Illuminate\Support\Facades\DB;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Coordinador::where('status', 'active')->get();

        return view('cat.index', array(
            'cats' => $cats
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cat.create');
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
            "Numero_cat" => "required|integer",
            "Nombre_cat" => "required|string",
            "Correo" => "email|required|string",
            "Telefono" => "required|numeric",
        ]);

        $emailExist = User::where('email', $request->Correo)->first();
        if ($emailExist) {
            return back()->withErrors(['Esta cuenta de correo ya fue registrada'])
                ->withInput(request(['Desarrollador', 'Municipio', 'Proyecto', 'Numero_cat', 'Nombre_cat', 'Correo', 'Telefono']));
        }

        DB::transaction(function () use ($request) {
            $user = new User();
            $user->email = $request->Correo;
            $user->type = 'coordinador';
            $user->password = bcrypt($request->Numero_cat);
            $user->save();
    
            $agenda_cat = new AgendaCat();
            $agenda_cat = self::agenda_cat($agenda_cat, $request);
            $agenda_cat->save();
    
            $cat = new Coordinador();
            $cat = self::coordinador($cat, $user, $agenda_cat, $request);
            $cat->save();
        });

        return redirect('/cat')
                    ->with('message', 'Se ha registrado al CAT correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Coordinador::findOrFail($id);
        return view('cat.show', array(
            'cat' => $cat
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
        $cat = Coordinador::findOrFail($id);
        return view('cat.edit', array(
            'cat' => $cat
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
        $cat = Coordinador::findOrFail($id);
        $user = User::findOrFail($cat->user_id);

        $validator = $this->validate($request, [
            "Desarrollador" => "required|string",
            "Municipio" => "required|string",
            "Proyecto" => "required|string",
            "Numero_cat" => "required|integer",
            "Nombre_cat" => "required|string",
            "Correo" => "email|required|string",
            "Telefono" => "required|numeric",
        ]);

        if ($request->Correo != $cat->user->email) {
            $emailExist = User::where('email', $request->Correo)->first();
            if ($emailExist) {
                return back()->withErrors(['Esta cuenta de correo ya fue registrada'])
                    ->withInput(request(['Desarrollador', 'Municipio', 'Proyecto', 'Numero_cat', 'Nombre_cat', 'Correo', 'Telefono']));
            } else {
                $user->email = $request->Correo;
                $user->update();
            }
        }

        $agenda_cat = AgendaCat::findOrFail($cat->agenda_cat_id);
        $agenda_cat = self::agenda_cat($agenda_cat, $request);
        $agenda_cat->update();

        $cat = self::coordinador($cat, $user, $agenda_cat, $request);
        $cat->update();

        return redirect('/cat')
                    ->with('message', 'Se ha actualizado al CAT correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Coordinador::findOrFail($id);
        $cat->status = 'inactive';
        $cat->save();

        return redirect('/cat')
                    ->with('message', 'Se ha eliminado al CAT correctamente');
    }

    private static function coordinador($cat, $user, $agenda_cat, $request)
    {
        $cat->user_id = $user->id;
        $cat->desarrollador = $request->Desarrollador;
        $cat->municipio = $request->Municipio;
        $cat->proyecto = $request->Proyecto;
        $cat->numero_cat = $request->Numero_cat;
        $cat->nombre = $request->Nombre_cat;
        $cat->telefono = $request->Telefono;
        $cat->agenda_cat_id = $agenda_cat->id;

        return $cat;
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
