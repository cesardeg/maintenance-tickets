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
        $familia = new Familia();
        $familia->nombre = 'Accesorios';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Muebles';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Equipamento';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Aplanados';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Banquetas';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Instalación eléctrica';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Instalación hidráulica';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Instalación sanitaria';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Instalación de gas';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Ductos de servicio (tv, tel, inter)';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Instalación de iluminación';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Impermeabilizante';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Puertas y marcos';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Pintura';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Recubrimiento cerámico';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Aluminio';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Enrejado-protecciones';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Herrajes y conexiones hidráulicas';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Acabados y firmes de escalera';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Registro medidor-murete';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Elementos de concreto';
        $familia->save();

        $familia = new Familia();
        $familia->nombre = 'Conducto de agua pluvial';
        $familia->save();
    }
}
