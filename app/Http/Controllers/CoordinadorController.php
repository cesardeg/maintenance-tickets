<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Coordinador;
use App\AgendaCat;
use App\User;
use App\Ticket;
use App\Http\Requests\CoordinadorStore;

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
    public function store(CoordinadorStore $request)
    {
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

        return redirect()->route('cat.show', $cat->id)
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
    public function update(CoordinadorStore $request, $id)
    {
        $cat = Coordinador::with('user')->findOrFail($id);
        $user = $cat->user;

        if ($request->Correo !== $user->email) {
            $user->email = $request->Correo;
            $user->update();
        }

        $agenda_cat = AgendaCat::findOrFail($cat->agenda_cat_id);
        $agenda_cat = self::agenda_cat($agenda_cat, $request);
        $agenda_cat->update();

        $cat = self::coordinador($cat, $user, $agenda_cat, $request);
        $cat->update();

        return redirect()->route('cat.show', $cat->id)
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

    public function schedule(Request $request)
    {
        $tickets = Ticket::where('cat_id', $request->cat_id)
            ->where('cita_cat', '>=', $request->start)
            ->where('cita_cat', '<=', $request->end)
            ->get();

        $data = $tickets->map(fn($tiket) => [
            'id' => $tiket->id,
            'title' => "#{$tiket->id}",
            'start' => $tiket->cita_cat,
            'end' => $tiket->cita_cat_fin,
        ]);

        return response()->json($data);
    }
}
