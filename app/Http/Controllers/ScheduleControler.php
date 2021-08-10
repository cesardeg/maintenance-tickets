<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manpower;
use App\Models\Ticket;

class ScheduleControler extends Controller
{
    public function coordinador(Request $request)
    {
        $items = Ticket::where('cat_id', $request->resource_id)
            ->where('cita_cat', '>=', $request->start)
            ->where('cita_cat', '<=', $request->end)
            ->get();

        $data = $items->map(fn($item) => [
            'id' => $item->id,
            'title' => "#{$item->id}",
            'start' => $item->cita_cat,
            'end' => $item->cita_cat_fin,
        ]);

        return response()->json($data);
    }

    public function contratista(Request $request)
    {
        $items = Manpower::with('ticket')
            ->whereHas('ticket')
            ->where('contratista_id', $request->resource_id)
            ->where('agendado_desde', '>=', $request->start)
            ->where('agendado_hasta', '<=', $request->end)
            ->get();

        $data = $items->map(fn($item) => [
            'id' => $item->id,
            'title' => "#{$item->ticket?->id}",
            'start' => $item->trabajado_desde ?? $item->agendado_desde,
            'end' => $item->trabajado_hasta ?? $item->agendado_hasta,
        ]);

        return response()->json($data);
    }
}
