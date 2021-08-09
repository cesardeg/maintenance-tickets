<?php

use Illuminate\Database\Seeder;
use App\Models\Condominio;

class CondominiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condominio = new Condominio();
        $condominio->nombre = 'Denali';
        $condominio->save();
    }
}
