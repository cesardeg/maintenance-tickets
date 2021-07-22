<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use DB;
use App\Contratista;

use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function vistaProyectos()
    {
        $startDay = Carbon::now()->subDays(30);
        $endDay = Carbon::now();

        $data = DB::select(
            "select proyecto, count(*) as total from tickets
            inner join (select id, proyecto from clientes group by proyecto) cl
            on tickets.cliente_id = cl.id
            where date(tickets.created_at) >= ?
            and date(tickets.created_at) <= ?
            group by proyecto;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return view('estadisticas.proyectos', array(
            'startDay' => $startDay->format('d/m/Y'),
            'endDay' => $endDay->format('d/m/Y'),
            'data' => $data
        ));
    }

    public function dataProyectos(Request $request)
    {
        $startDay = Carbon::createFromFormat("d/m/Y", $request->startDay);
        $endDay = Carbon::createFromFormat("d/m/Y", $request->endDay);

        $data = DB::select(
            "select proyecto, count(*) as total from tickets
            inner join (select id, proyecto from clientes group by proyecto) cl
            on tickets.cliente_id = cl.id
            where date(tickets.created_at) >= ?
            and date(tickets.created_at) <= ?
            group by proyecto;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return $data;
    }

    public function vistaContratista()
    {
        $startDay = Carbon::now()->subDays(30);
        $endDay = Carbon::now();
        $contratistas = Contratista::get();

        if($contratistas->count() > 0){
            $data = DB::select(
                "select cont.nombre as nombre, count(*) as total from detalle_tickets
                inner join (select * from contratistas where id = ?) cont
                on detalle_tickets.contratista_id = cont.id
                where date(detalle_tickets.created_at) >= ?
                and date(detalle_tickets.created_at) <= ?
                group by contratista_id;",
                [$contratistas->first()->id, $startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
            );

            return view('estadisticas.contratista', array(
                'startDay' => $startDay->format('d/m/Y'),
                'endDay' => $endDay->format('d/m/Y'),
                'contratistas' => $contratistas,
                'data' => $data
            ));
        }else{
            return view('estadisticas.contratista', array(
                'data' => null
            ));
        }


    }

    public function dataContratista(Request $request)
    {
        $startDay = Carbon::createFromFormat("d/m/Y", $request->startDay);
        $endDay = Carbon::createFromFormat("d/m/Y", $request->endDay);

        $data = DB::select(
            "select cont.nombre as nombre, count(*) as total from detalle_tickets
            inner join (select * from contratistas where id = ?) cont
            on detalle_tickets.contratista_id = cont.id
            where date(detalle_tickets.created_at) >= ?
            and date(detalle_tickets.created_at) <= ?
            group by contratista_id;",
            [$request->cont_id, $startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return $data;
    }

    public function vistaValoracion()
    {
        $startDay = Carbon::now()->subDays(30);
        $endDay = Carbon::now();

        $data = DB::select(
            "select round(DATEDIFF( date(created_at) , fecha_visita) / count(*)) as total
            from tickets
            where date(created_at) >= ?
            and date(created_at) <= ?
            and fecha_visita is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return view('estadisticas.valoracion', array(
            'startDay' => $startDay->format('d/m/Y'),
            'endDay' => $endDay->format('d/m/Y'),
            'data' => $data
        ));
    }

    public function dataValoracion(Request $request)
    {
        $startDay = Carbon::createFromFormat("d/m/Y", $request->startDay);
        $endDay = Carbon::createFromFormat("d/m/Y", $request->endDay);

        $data = DB::select(
            "select round(DATEDIFF( date(created_at) , fecha_visita) / count(*)) as total
            from tickets
            where date(created_at) >= ?
            and date(created_at) <= ?
            and fecha_visita is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return $data;
    }

    public function vistaSolucion()
    {
        $startDay = Carbon::now()->subDays(30);
        $endDay = Carbon::now();

        $data = DB::select(
            "select round(DATEDIFF( date(created_at) , fecha_finalizado) / count(*)) as total
            from tickets
            where date(created_at) >= ?
            and date(created_at) <= ?
            and fecha_finalizado is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return view('estadisticas.solucion', array(
            'startDay' => $startDay->format('d/m/Y'),
            'endDay' => $endDay->format('d/m/Y'),
            'data' => $data
        ));
    }

    public function dataSolucion(Request $request)
    {
        $startDay = Carbon::createFromFormat("d/m/Y", $request->startDay);
        $endDay = Carbon::createFromFormat("d/m/Y", $request->endDay);

        $data = DB::select(
            "select round(DATEDIFF( date(created_at) , fecha_finalizado) / count(*)) as total
            from tickets
            where date(created_at) >= ?
            and date(created_at) <= ?
            and fecha_finalizado is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return $data;
    }

    public function vistaSatisfaccion()
    {
        $startDay = Carbon::now()->subDays(30);
        $endDay = Carbon::now();

        $data = DB::select(
            "select round( SUM(pregunta_1) / count(*)) as total_1,
            round( SUM(pregunta_2) / count(*)) as total_2,
            round( SUM(pregunta_3) / count(*)) as total_3,
            round( SUM(pregunta_4) / count(*)) as total_4,
            round( SUM(pregunta_5) / count(*)) as total_5
            from encuestas
            inner join (select * from tickets where estado = 'Terminada') ticket
            on encuestas.ticket_id = ticket.id
            where `active` = 0
            and date(encuestas.created_at) >= ?
            and date(encuestas.created_at) <= ?
            and active is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return view('estadisticas.satisfaccion', array(
            'startDay' => $startDay->format('d/m/Y'),
            'endDay' => $endDay->format('d/m/Y'),
            'data' => $data
        ));
    }

    public function dataSatisfaccion(Request $request)
    {
        $startDay = Carbon::createFromFormat("d/m/Y", $request->startDay);
        $endDay = Carbon::createFromFormat("d/m/Y", $request->endDay);

        $data = DB::select(
            "select round( SUM(pregunta_1) / count(*)) as total_1,
            round( SUM(pregunta_2) / count(*)) as total_2,
            round( SUM(pregunta_3) / count(*)) as total_3,
            round( SUM(pregunta_4) / count(*)) as total_4,
            round( SUM(pregunta_5) / count(*)) as total_5
            from encuestas
            inner join (select * from tickets where estado = 'Terminada') ticket
            on encuestas.ticket_id = ticket.id
            where `active` = 0
            and date(encuestas.created_at) >= ?
            and date(encuestas.created_at) <= ?
            and active is not null;",
            [$startDay->format('Y/m/d'), $endDay->format('Y/m/d')]
        );

        return $data;
    }

}
