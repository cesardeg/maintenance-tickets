<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratistas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('desarrollador');
            $table->string('municipio');
            $table->string('proyecto');
            $table->integer('numero_contratista');
            $table->string('empresa');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('fecha_producto_obra');
            $table->string('fecha_producto_vivienda');
            $table->string('coordinador');
            $table->bigInteger('agenda_tc_id');
            $table->bigInteger('agenda_cat_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratistas');
    }
}
