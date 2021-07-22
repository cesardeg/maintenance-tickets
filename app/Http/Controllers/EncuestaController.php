<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuesta;

class EncuestaController extends Controller
{
    public function store(Request $request, $encuesta_id)
    {
        $encuesta = Encuesta::findOrFail($encuesta_id);
        $encuesta->pregunta_1 = $request->pregunta_1;
        $encuesta->pregunta_2 = $request->pregunta_2;
        $encuesta->pregunta_3 = $request->pregunta_3;
        $encuesta->pregunta_4 = $request->pregunta_4;
        $encuesta->pregunta_5 = $request->pregunta_5;
        $encuesta->active = false;
        $encuesta->save();

        return redirect('/tickets')
                    ->with('message', 'Se ha registrado la encuesta correctamente');
    }

    public function show($encuesta_id)
    {
        $encuesta = Encuesta::findOrFail($encuesta_id);

        return view('encuesta.show', array(
            'encuesta' => $encuesta,
        ));
    }
}
