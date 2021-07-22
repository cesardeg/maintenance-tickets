<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id');
            $table->enum('estado', ['Sin visitar', 'Valorada', 'En progreso', 'Terminada', 'Cancelada'])->default('Sin visitar');
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->date('cita_cat')->nullable();
            $table->dateTime('cita_atencion_1')->nullable();
            $table->dateTime('cita_atencion_2')->nullable();
            $table->dateTime('cita_atencion_3')->nullable();
            $table->string('prototipo')->nullable();
            $table->date('fecha_visita')->nullable();
            $table->date('fecha_finalizado')->nullable();
            $table->timestamps();

            //Foreign Keys
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('cat_id')->references('id')->on('cat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function ($table) {
            $table->dropForeign('tickets_cliente_id_foreign');
            $table->dropForeign('tickets_cat_id_foreign'); 
        });
        Schema::dropIfExists('tickets');
    }
}
