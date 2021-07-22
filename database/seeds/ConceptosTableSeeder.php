<?php

use Illuminate\Database\Seeder;
use App\Concepto;
use App\Familia;

class ConceptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(1);

        $concepto = new Concepto();         // 1
        $concepto->nombre = 'Jabonera-portacepillo-portapales';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Sanitario-asiento';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Cesto de basura';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Mosquitero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Dispoisitivo de ahorradores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Focos ahorradores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(2);

        $concepto = new Concepto();         // 7
        $concepto->nombre = 'Lavamanos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        $concepto = new Concepto();
        $concepto->nombre = 'Sanitario';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        $concepto = new Concepto();
        $concepto->nombre = 'Lavadero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(3);

        $concepto = new Concepto();         // 10
        $concepto->nombre = 'Cancel de baño';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Cocina integral';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Tarja';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Closets';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Boiler';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Cisterna';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Hidroneumático';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Tinaco';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(4);

        $concepto = new Concepto();         // 18
        $concepto->nombre = 'Aplanados interiores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(5);

        $concepto = new Concepto();         // 19
        $concepto->nombre = 'Banqueta municipal';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Huellas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(6);

        $concepto = new Concepto();         // 21
        $concepto->nombre = 'Linea-cableado';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Break';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Revestido';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Tomas-apagadores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Sockets';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Centro de carga';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(7);

        $concepto = new Concepto();     // 27
        $concepto->nombre = 'Lineas-tuberia';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Llaves';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Mezcladora';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Manerales';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Regadera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(8);

        $concepto = new Concepto();         // 32
        $concepto->nombre = 'Linea-drenaje';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Descargas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Registro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(9);

        $concepto = Concepto::findOrFail(27);
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(28);
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();         // 35
        $concepto->nombre = 'Tapones';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(10);

        $concepto = Concepto::findOrFail(34);
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();         // 36
        $concepto->nombre = 'Ductos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(11);

        $concepto = new Concepto();         // 37
        $concepto->nombre = 'Domo';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Linternilla';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(12);

        $concepto = new Concepto();         // 39
        $concepto->nombre = 'Techo';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Muros';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Pretiles';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Gargola';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Bajantes pluviales';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(13);

        $concepto = new Concepto();         // 44
        $concepto->nombre = 'Puertas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Marcos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Bisagras';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Chapas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(28);
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(14);

        $concepto = new Concepto();         // 48
        $concepto->nombre = 'Interior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Exterior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(15);

        $concepto = new Concepto();         // 50
        $concepto->nombre = 'Piso interior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Piso exterior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Areas humedas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(16);

        $concepto = new Concepto();         // 53
        $concepto->nombre = 'Ventanas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(44);
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(4);
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Broche/seguro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Perfiles';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Sellos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(17);

        $concepto = Concepto::findOrFail(53);
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(44);
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(18);

        $concepto = new Concepto();         // 57
        $concepto->nombre = 'Mangueras alimentadoras';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(28);
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Herraje wc';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Herraje tinaco-cisterna';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Cebolleta';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Valvula check';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(19);

        $concepto = new Concepto();         // 62
        $concepto->nombre = 'Firmes';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Escalera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(20);

        $concepto = new Concepto();         // 64
        $concepto->nombre = 'Caja-banqueta';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Acometida';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(21);

        $concepto = new Concepto();         // 66
        $concepto->nombre = 'Losa-techos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::findOrFail(40);
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Piso';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(22);

        $concepto = new Concepto();         // 68
        $concepto->nombre = 'Linea pluvial';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Arenero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Boca-bajada';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = new Concepto();
        $concepto->nombre = 'Rebosadero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
    }
}
