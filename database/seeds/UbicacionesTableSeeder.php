<?php

use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Recámara Principal';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Recámara Secundaria';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Tercera recámara';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Cuarta recámara';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Cuarto de servicio';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Lavandería';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Patio';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Roof garden';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Baño recámara principal';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Baño planta baja';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Baño planta alta';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Estancia de Tv';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Escaleras';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Sala';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Cocina';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Comedor';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Cochera';
        $ubicacion->save();

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = 'Azotea';
        $ubicacion->save();
    }
}
