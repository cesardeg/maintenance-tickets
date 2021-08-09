<?php

use Illuminate\Database\Seeder;
use App\Models\Familia;

class FamiliasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familia = Familia::firstOrNew(['id' => 1]);
        $familia->nombre = 'Accesorios';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 2]);
        $familia->nombre = 'Muebles';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 3]);
        $familia->nombre = 'Equipamento';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 4]);
        $familia->nombre = 'Aplanados';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 5]);
        $familia->nombre = 'Banquetas';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 6]);
        $familia->nombre = 'Instalación eléctrica';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 7]);
        $familia->nombre = 'Instalación hidráulica';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 8]);
        $familia->nombre = 'Instalación sanitaria';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 9]);
        $familia->nombre = 'Instalación de gas';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 10]);
        $familia->nombre = 'Intalación de ductos (voz y datos)';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 11]);
        $familia->nombre = 'Instalación de iluminación';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 12]);
        $familia->nombre = 'Impermeabilizante';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 13]);
        $familia->nombre = 'Marcos y puertas';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 14]);
        $familia->nombre = 'Pintura';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 15]);
        $familia->nombre = 'Recubrimiento cerámico';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 16]);
        $familia->nombre = 'Aluminio';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 17]);
        $familia->nombre = 'Herrería';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 18]);
        $familia->nombre = 'Herrajes y conexiones hidráulicas';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 19]);
        $familia->nombre = 'Acabados firmes de escaleras';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 20]);
        $familia->nombre = 'Cuadro de medición';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 21]);
        $familia->nombre = 'Elementos de concreto';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 22]);
        $familia->nombre = 'Conducción de agua pluvial';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 23]);
        $familia->nombre = 'Instalación de teléfono';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 24]);
        $familia->nombre = 'Instalación de cable';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 25]);
        $familia->nombre = 'Chapas y llaves';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 26]);
        $familia->nombre = 'Componentes decorativos y estéticos';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 27]);
        $familia->nombre = 'Limpieza';
        $familia->save();

        $familia = Familia::firstOrNew(['id' => 28]);
        $familia->nombre = 'Bardas y/o enrejados exteriores';
        $familia->save();
    }
}
