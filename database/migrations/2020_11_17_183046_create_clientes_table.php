<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('desarrollador');
            $table->string('municipio');
            $table->bigInteger('condominio_id');
            $table->integer('numero_cliente');
            $table->string('nombre');
            $table->string('coopropietario');
            $table->string('telefono');
            $table->string('fecha_escrituracion');
            $table->string('fecha_poliza');
            $table->string('fecha_entrega');
            $table->text('comentarios')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
