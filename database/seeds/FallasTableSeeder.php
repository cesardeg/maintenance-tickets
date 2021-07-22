<?php

use Illuminate\Database\Seeder;
use App\Falla;
use App\Familia;

class FallasTableSeeder extends Seeder
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

        $falla = new Falla();         // 1
        $falla->nombre = 'Mala fijacion';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Dañado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Defecto de fábrica';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Mal instalado';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(2);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(3);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = new Falla(); // 5
        $falla->nombre = 'Dañado-sucio';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(4);

        $falla = new Falla();         // 6
        $falla->nombre = 'Junta cosntructiva';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Craquelado en yeso-enjarre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Fisura en yeso-enjarre  por proceso de obra';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Desprendimiento de yeso-enjarre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Acabado deficiente ';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Boquilla mal ejecutada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Humedad por fisuras';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Humedad por junta constructiva';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Humedad por pendiente de boquilla';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Fisura estructural';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(5);

        $falla = new Falla();         // 16
        $falla->nombre = 'Fisurada/fracturada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(6);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 18
        $falla->nombre = 'Chueco, despegado, flojo';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(7);

        $falla = new Falla();     // 19
        $falla->nombre = 'Tapón';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Fuga';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(8);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 21
        $falla->nombre = 'Instalacion incompleta';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(9);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(10);

        $falla = new Falla();         // 22
        $falla->nombre = 'Guía no está colocada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(11);

        $falla = new Falla();         // 23
        $falla->nombre = 'Sello de poliuretano deteriorado-faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Falta malla-acrilico';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(12);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 25
        $falla->nombre = 'Rasgadura';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Instalacion incompleta/mal ejecutada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Encharcamiento';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Bajante mal recibido';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(13);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 29
        $falla->nombre = 'Chapacinta despegada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Sello acrilastik mal aplocado/faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(14);

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 31
        $falla->nombre = 'Homogneidad';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Craquelado';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(15);

        $falla = new Falla();         // 33
        $falla->nombre = 'Pieza quebrada/despostillada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Piso desnivelado/topes';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Piso hueco';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Piso despegado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Junteo desprendido';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(16);

        $falla = new Falla();         // 38
        $falla->nombre = 'Filtracion puerta/ventana';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Mal funcionamiento';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Descuadre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Roto/dañado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Sello de poliuretano deteriorado-faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(17);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 43
        $falla->nombre = 'Oxidado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Mal pintado';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(18);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(19);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(20);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(21);

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(22);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = new Falla();         // 45
        $falla->nombre = 'Forjado/albañileria';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Niveles entre areneros mal ejecutados';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Rejilla mal instalada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = new Falla();
        $falla->nombre = 'Limpieza';
        $falla->save();
        $familia->fallas()->attach($falla);
    }
}
