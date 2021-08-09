<?php

use Illuminate\Database\Seeder;
use App\Models\Falla;
use App\Models\Familia;

class FallasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('falla_familia')->truncate();

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(1); // Accesorios

        $falla = Falla::firstOrNew(['id' => 1]);         // 1
        $falla->nombre = 'Mala fijación';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 1]);
        $falla->nombre = 'Dañado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 3]);
        $falla->nombre = 'Defecto de fabrica';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 4]);
        $falla->nombre = 'Mal instalado';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(2); // Muebles

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(3); // Equipamento

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 5]); // 5
        $falla->nombre = 'Manchado o rallado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 16]);         // 16
        $falla->nombre = 'Fisurada/fracturada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 48]);
        $falla->nombre = 'Filtración de agua';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(4);  // Aplanados

        $falla = Falla::firstOrNew(['id' => 6]);         // 6
        $falla->nombre = 'Junta cosntructiva';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 7]);
        $falla->nombre = 'Craquelado en yeso/enjarre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 8]);
        $falla->nombre = 'Fisura en yeso/enjarre por proceso civil';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 9]);
        $falla->nombre = 'Desprendimiento de yeso/enjarre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 10]);
        $falla->nombre = 'Acabado deficiente';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 11]);
        $falla->nombre = 'Boquilla mal ejecutada en yeso/enjarre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 49]);
        $falla->nombre = 'Filos y aristas mal ejecutadas';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 12]);
        $falla->nombre = 'Humedad por fisuras en enjarre boquilla';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 53]);
        $falla->nombre = 'Humedad por fisuras en enjarre muro';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 13]);
        $falla->nombre = 'Humedad por junta constructiva';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 14]);
        $falla->nombre = 'Humedad por pendiente de boquilla';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 50]);
        $falla->nombre = 'Humedad por pintura';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 51]);
        $falla->nombre = 'Humedad por área verde o desnivel';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 52]);
        $falla->nombre = 'Humedad por falta de sello en placa';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 15]);
        $falla->nombre = 'Fisura estructural';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(5); // Banquetas

        $falla = Falla::findOrFail(16);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(6); // Instalación eléctrica

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 17]);         // 17
        $falla->nombre = 'Chueco, despegado, flojo';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 54]);         // 17
        $falla->nombre = 'Falta de nomenclatura';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(7); // Instalación hidráulica 

        $falla = Falla::firstOrNew(['id' => 18]);     // 18
        $falla->nombre = 'Tapón';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 19]);
        $falla->nombre = 'Fuga';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(8); // Instalación sanitaria 

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 20]);         // 20
        $falla->nombre = 'Instalacion incompleta';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 55]);         // 20
        $falla->nombre = 'Instalación no esta deacuerdo al proyecto';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 56]);         // 20
        $falla->nombre = 'Forjado interior';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(9); // Instalación de gas

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 57]);         // 20
        $falla->nombre = 'Consumo excesivo';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(10); // Instalación de ductos (voz y datos)

        $falla = Falla::firstOrNew(['id' => 21]);         // 21
        $falla->nombre = 'Guía no está colocada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(11); // Instalación de iluminación 

        $falla = Falla::firstOrNew(['id' => 22]);         // 22
        $falla->nombre = 'Sello de poliuretano deteriorado-faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 23]);
        $falla->nombre = 'Falta malla-acrilico';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(55);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(12); // Impermeabilizante 

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 24]);         // 24
        $falla->nombre = 'Rasgadura';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 25]);
        $falla->nombre = 'Instalacion incompleta/mal ejecutada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 26]);
        $falla->nombre = 'Encharcamiento';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 27]);
        $falla->nombre = 'Bajante mal recibido';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(13); // Marcos y puertas 

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 28]);         // 28
        $falla->nombre = 'Chapacinta despegada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 29]);
        $falla->nombre = 'Sello acrilastik mal aplicado/faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 58]);
        $falla->nombre = 'Golpe en marco';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 59]);
        $falla->nombre = 'Contra chapa';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 60]);
        $falla->nombre = 'Cabeceo en puerta';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 61]);
        $falla->nombre = 'Chapa cinta despegada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 62]);
        $falla->nombre = 'Desprendimiento de zoclo';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(14); // Pintura 

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 30]);         // 30
        $falla->nombre = 'Homogneidad';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 31]);
        $falla->nombre = 'Craquelado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 63]);
        $falla->nombre = 'Barreado';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(15); // Recubrimiento cerámico

        $falla = Falla::firstOrNew(['id' => 32]);         // 32
        $falla->nombre = 'Pieza quebrada/despostillada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 33]);
        $falla->nombre = 'Desnivelado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 34]);
        $falla->nombre = 'Pieza hueca';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 35]);
        $falla->nombre = 'Pieza despegado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 36]);
        $falla->nombre = 'Junteo desprendido';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 64]);
        $falla->nombre = 'Cezpol mal recibido';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 65]);
        $falla->nombre = 'Junteo deficiente';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 66]);
        $falla->nombre = 'Humedad por junteo';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(16); // Aluminio 

        $falla = Falla::firstOrNew(['id' => 37]);         // 37
        $falla->nombre = 'Filtración puerta/ventana';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 38]);
        $falla->nombre = 'Mal funcionamiento';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 39]);
        $falla->nombre = 'Descuadre';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 40]);
        $falla->nombre = 'Roto/dañado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 41]);
        $falla->nombre = 'Sello de poliuretano deteriorado-faltante';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 41]);
        $falla->nombre = 'Vidrios flojos / endebles';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(17); // Herrería

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 42]);         // 42
        $falla->nombre = 'Oxidado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 43]);
        $falla->nombre = 'Mal pintado';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 67]);
        $falla->nombre = 'Detalles en soldadura';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(18); // Herrajes y conexiones hidráulicas

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
        $familia = Familia::findOrFail(19); // Acabados firmes de escaleras 

        $falla = Falla::firstOrNew(['id' => 68]);
        $falla->nombre = 'Acabado deficiente en peralte';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 69]);
        $falla->nombre = 'Nivelación de huella deficiente';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 70]);
        $falla->nombre = 'Madera de escalón flojo';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 71]);
        $falla->nombre = 'Acabado deficiente en madera escalón';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 72]);
        $falla->nombre = 'Madera mal instalada';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(20); // Cuadro de medición 

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(21); // Elementos de concreto

        $falla = Falla::findOrFail(10);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(22); // Conducción  de agua pluvial 

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(19);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 44]);         // 45
        $falla->nombre = 'Forjado/albañileria';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 45]);
        $falla->nombre = 'Niveles entre areneros mal ejecutados';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 46]);
        $falla->nombre = 'Rejilla mal instalada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 47]);
        $falla->nombre = 'Limpieza';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 73]);
        $falla->nombre = 'Exceso de grava';
        $falla->save();
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(23); // Instalación de teléfono

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(21);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(24); // Instalación de cable 

        $falla = Falla::findOrFail(18);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(20);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(21);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(25); // Chapas y llaves 

        $falla = Falla::findOrFail(3);
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(4);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(26); // Componentes decorativos  y estéticos 

        $falla = Falla::firstOrNew(['id' => 74]);
        $falla->nombre = 'Desprendimiento de murete';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::firstOrNew(['id' => 75]);
        $falla->nombre = 'Desprendimiento de fachada';
        $falla->save();
        $familia->fallas()->attach($falla);

        $falla = Falla::findOrFail(65);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(27); // Limpieza

        $falla = Falla::findOrFail(47);
        $familia->fallas()->attach($falla);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(28); // Bardas y/o enrejados exteriores 
    }
}
