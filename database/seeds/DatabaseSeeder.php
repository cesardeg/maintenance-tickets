<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FamiliasTableSeeder::class);
        $this->call(ConceptosTableSeeder::class);
        $this->call(FallasTableSeeder::class);
        $this->call(UbicacionesTableSeeder::class);
        $this->call(CondominiosTableSeeder::class);
    }
}
