<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('familia_id');
            $table->unsignedBigInteger('concepto_id');
            $table->unsignedBigInteger('falla_id');
            $table->unsignedBigInteger('contratista_id')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->text('observacion')->nullable();
            $table->enum('valoracion', ['Si', 'No', 'Pendiente'])->default('Pendiente');
            $table->enum('estado', ['Espera', 'En proceso', 'Terminada'])->default('Espera');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('contratista_id')->references('id')->on('contratistas');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_tickets', function ($table) {
            $table->dropForeign('detalle_tickets_ticket_id_foreign');
            $table->dropForeign('detalle_tickets_contratista_id_foreign');
            $table->dropForeign('detalle_tickets_ubicacion_id_foreign'); 
        });
        Schema::dropIfExists('detalle_tickets');
    }
}
