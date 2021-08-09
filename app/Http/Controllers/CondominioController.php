<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condominio;

class CondominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condominios = Condominio::all();

        return view('condominios.index', array(
            'condominios' => $condominios
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('condominios.create');
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
            "Nombre" => "required|string",
        ]);

        $condominio = new Condominio();
        $condominio->nombre = $request->Nombre;
        $condominio->save();

        return redirect('/condominios')
                    ->with('message', 'Se ha registrado el condominio correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condominio = Condominio::findOrFail($id);
        return view('condominios.show', array(
            'condominio' => $condominio
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
        $condominio = Condominio::findOrFail($id);
        return view('condominios.edit', array(
            'condominio' => $condominio
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
        $validator = $this->validate($request, [
            "Nombre" => "required|string",
        ]);

        $condominio = Condominio::findOrFail($id);
        $condominio->nombre = $request->Nombre;
        $condominio->save();

        return redirect('/condominios')
                    ->with('message', 'Se ha modificado el condominio correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/condominios');
    }
}
