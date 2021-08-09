<?php

use Illuminate\Database\Seeder;
use App\Models\Concepto;
use App\Models\Familia;

class ConceptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('concepto_familia')->truncate();

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(1); // Accesorios

        $concepto = Concepto::firstOrNew(['id' => 1]);         // 1
        $concepto->nombre = 'Jabonera / Portacepillo / Portapel';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 2]);
        $concepto->nombre = 'Sanitario (asiento)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 3]);
        $concepto->nombre = 'Cesto de basura';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 4]);
        $concepto->nombre = 'Mosquitero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 5]);
        $concepto->nombre = 'Dispositivos de ahorradores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 6]);
        $concepto->nombre = 'Focos ahorradores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(2); // Muebles

        $concepto = Concepto::firstOrNew(['id' => 7]);         // 7
        $concepto->nombre = 'Lavabo / Ovalín (baño)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        $concepto = Concepto::firstOrNew(['id' => 8]);
        $concepto->nombre = 'Sanitario (baño)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        $concepto = Concepto::firstOrNew(['id' => 9]);
        $concepto->nombre = 'Lavadero (lavandería)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(3); // Equipamento

        $concepto = Concepto::firstOrNew(['id' => 10]);         // 10
        $concepto->nombre = 'Cancel de baño';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 11]);
        $concepto->nombre = 'Cocina integral';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 12]);
        $concepto->nombre = 'Tarja (cocina)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 72]);
        $concepto->nombre = 'Tarja (lavandería)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 13]);
        $concepto->nombre = 'Closets';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 14]);
        $concepto->nombre = 'Calentador / Boiler';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 15]);
        $concepto->nombre = 'Cisterna';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 16]);
        $concepto->nombre = 'Hidroneumático';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 17]);
        $concepto->nombre = 'Tinaco';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 73]);
        $concepto->nombre = 'Barra piedra / granito';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(4); // Aplanados

        $concepto = Concepto::firstOrNew(['id' => 18]);         // 18
        $concepto->nombre = 'Aplanados interiores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 74]);
        $concepto->nombre = 'Aplanados exteriores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 75]);
        $concepto->nombre = 'Yesos (aplanados interiores)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 76]);
        $concepto->nombre = 'Texturas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(5); // Banquetas

        $concepto = Concepto::firstOrNew(['id' => 19]);         // 19
        $concepto->nombre = 'Banqueta municipal';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 20]);
        $concepto->nombre = 'Huellas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(6); // Instalación eléctrica

        $concepto = Concepto::firstOrNew(['id' => 21]);         // 21
        $concepto->nombre = 'Linea / Cableado';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 22]);
        $concepto->nombre = 'Break';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 23]);
        $concepto->nombre = 'Revestido';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 24]);
        $concepto->nombre = 'Tomas / Apagadores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 25]);
        $concepto->nombre = 'Rosetas / Sockets';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 26]);
        $concepto->nombre = 'Centro de carga';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 77]);
        $concepto->nombre = 'Breaks / Fusibles / Interruptores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(7); // Instalación hidráulica 

        $concepto = Concepto::firstOrNew(['id' => 27]);     // 27
        $concepto->nombre = 'Líneas - tuberías';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 28]);
        $concepto->nombre = 'Llaves';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 29]);
        $concepto->nombre = 'Llaves mezcladoras (lavamanos)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 78]);
        $concepto->nombre = 'Llaves mezcladoras (cocina)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 79]);
        $concepto->nombre = 'Llaves mezcladoras (lavabo)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 80]);
        $concepto->nombre = 'Llaves (lavandería)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 81]);
        $concepto->nombre = 'Llaves (tarja)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 82]);
        $concepto->nombre = 'Llaves (jardín)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 30]);
        $concepto->nombre = 'Manerales';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 31]);
        $concepto->nombre = 'Regadera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(8); // Instalación sanitaria 

        $concepto = Concepto::firstOrNew(['id' => 32]);         // 32
        $concepto->nombre = 'Línea drenaje';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 33]);
        $concepto->nombre = 'Descargas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 34]);
        $concepto->nombre = 'Registro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 83]);
        $concepto->nombre = 'Llaves';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 84]);
        $concepto->nombre = 'Tapones';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(9); // Instalación de gas

        $concepto = Concepto::firstOrNew(['id' => 85]);     // 27
        $concepto->nombre = 'Líneas - tuberías';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 86]);
        $concepto->nombre = 'Llaves';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 35]);         // 35
        $concepto->nombre = 'Tapones';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
        
        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(10); // Instalación de ductos (voz y datos)

        $concepto = Concepto::firstOrNew(['id' => 36]);         // 36
        $concepto->nombre = 'Ductos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 87]);
        $concepto->nombre = 'Roseta para internet';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 88]);
        $concepto->nombre = 'Ventilas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(11); // Instalación de iluminación 

        $concepto = Concepto::firstOrNew(['id' => 37]);         // 37
        $concepto->nombre = 'Domos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 38]);
        $concepto->nombre = 'Linternillas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(12); // Impermeabilizante 

        $concepto = Concepto::firstOrNew(['id' => 39]);         // 39
        $concepto->nombre = 'Techo';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 40]);
        $concepto->nombre = 'Muros';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 41]);
        $concepto->nombre = 'Pretiles';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 42]);
        $concepto->nombre = 'Gargola';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 43]);
        $concepto->nombre = 'Bajantes pluviales';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 89]);
        $concepto->nombre = 'Chaflanes / Paloma / Diamante';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(13); // Marcos y puertas 

        $concepto = Concepto::firstOrNew(['id' => 44]);         // 44
        $concepto->nombre = 'Puertas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 45]);
        $concepto->nombre = 'Marcos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 46]);
        $concepto->nombre = 'Bisagras';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 47]);
        $concepto->nombre = 'Chapas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 90]);
        $concepto->nombre = 'Vitral';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 91]);
        $concepto->nombre = 'Zoclos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);


        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(14); // Pintura 

        $concepto = Concepto::firstOrNew(['id' => 48]);         // 48
        $concepto->nombre = 'Interior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 49]);
        $concepto->nombre = 'Exterior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 92]);
        $concepto->nombre = 'Áreas humedas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 93]);
        $concepto->nombre = 'Áreas muebles';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(15); // Recubrimiento cerámico

        $concepto = Concepto::firstOrNew(['id' => 50]);         // 50
        $concepto->nombre = 'Piso interior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 51]);
        $concepto->nombre = 'Piso exterior';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 52]);
        $concepto->nombre = 'Áreas humedas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 94]);
        $concepto->nombre = 'Piso áreas humedas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 95]);
        $concepto->nombre = 'Muros exteriores';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 96]);
        $concepto->nombre = 'Boquillas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(16); // Aluminio 

        $concepto = Concepto::firstOrNew(['id' => 53]);         // 53
        $concepto->nombre = 'Ventanas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 97]);         // 53
        $concepto->nombre = 'Puertas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 54]);
        $concepto->nombre = 'Broches / Seguros';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 55]);
        $concepto->nombre = 'Perfiles';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 56]);
        $concepto->nombre = 'Sellos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 98]);
        $concepto->nombre = 'Vidrios';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(17); // Herrería

        $concepto = Concepto::firstOrNew(['id' => 99]);
        $concepto->nombre = 'Cancel de cochera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(18); // Herrajes y conexiones hidráulicas

        $concepto = Concepto::firstOrNew(['id' => 57]);         // 57
        $concepto->nombre = 'Mangueras alimentadoras';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 100]);
        $concepto->nombre = 'Llaves de paso (WC / Lavabo / Zinc / Tarja / 59Lavandería)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 58]);
        $concepto->nombre = 'Herraje de sanitario';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 59]);
        $concepto->nombre = 'Herraje tinaco / cisterna / flotador';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 60]);
        $concepto->nombre = 'Cebolleta';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 61]);
        $concepto->nombre = 'Valvula check';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 101]);
        $concepto->nombre = 'Trampas de desagüe';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(19); // Acabados firmes de escaleras 

        $concepto = Concepto::firstOrNew(['id' => 62]);         // 62
        $concepto->nombre = 'Firmes';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 63]);
        $concepto->nombre = 'Escalera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(20); // Cuadro de medición 

        $concepto = Concepto::firstOrNew(['id' => 64]);         // 64
        $concepto->nombre = 'Caja (banqueta)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 65]);
        $concepto->nombre = 'Acometida eléctrica';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 102]);
        $concepto->nombre = 'Terreno natural';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(21); // Elementos de concreto 

        $concepto = Concepto::firstOrNew(['id' => 66]);         // 66
        $concepto->nombre = 'Losas / Techos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 67]);
        $concepto->nombre = 'Pisos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 103]);
        $concepto->nombre = 'Muros';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 104]);
        $concepto->nombre = 'Elementos decorativos';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(22); // Conducción  de agua pluvial 

        $concepto = Concepto::firstOrNew(['id' => 68]);         // 68
        $concepto->nombre = 'Linea pluvial';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 69]);
        $concepto->nombre = 'Caja pluvial (arenero)';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 70]);
        $concepto->nombre = 'Boca bajada pluvial';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 71]);
        $concepto->nombre = 'Rebosadero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 105]);
        $concepto->nombre = 'Gotero';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(23); // Instalación de teléfono 

        $concepto = Concepto::firstOrNew(['id' => 106]);         // 68
        $concepto->nombre = 'Poliducto';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 107]);
        $concepto->nombre = 'Registro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(24); // Instalación de cable 

        $concepto = Concepto::firstOrNew(['id' => 108]);         // 68
        $concepto->nombre = 'Poliducto';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 109]);
        $concepto->nombre = 'Registro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(25); // Chapas y llaves 

        $concepto = Concepto::firstOrNew(['id' => 110]);         // 68
        $concepto->nombre = 'Chapas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 111]);
        $concepto->nombre = 'Llaves';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(26); // Componentes decorativos  y estéticos 

        $concepto = Concepto::firstOrNew(['id' => 112]);         // 68
        $concepto->nombre = 'Fachaleta';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 113]);
        $concepto->nombre = 'Molduras y/o cornizas';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 114]);
        $concepto->nombre = 'Cantera';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(27); // Limpieza

        $concepto = Concepto::firstOrNew(['id' => 115]);         // 68
        $concepto->nombre = 'Retiro de escombro';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 116]);
        $concepto->nombre = 'Limpieza fina';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        /*  --------------------------- */
        /*  --------- Familia --------- */
        $familia = Familia::findOrFail(28); // Bardas y/o enrejados exteriores 

        $concepto = Concepto::firstOrNew(['id' => 115]);         // 68
        $concepto->nombre = 'Barda medianera de vivienda';
        $concepto->save();
        $familia->conceptos()->attach($concepto);

        $concepto = Concepto::firstOrNew(['id' => 116]);
        $concepto->nombre = 'Barda cabecera / perimetral';
        $concepto->save();
        $familia->conceptos()->attach($concepto);
    }
}
