<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndDateCita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    
        Schema::table('tickets', function (Blueprint $table) {
            $table->dateTime('cita_cat')->nullable()->change();
            $table->dateTime('cita_cat_fin')->nullable()->after('cita_cat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('cita_cat_fin');
            $table->date('cita_cat')->nullable()->change();
        });
    }
}
