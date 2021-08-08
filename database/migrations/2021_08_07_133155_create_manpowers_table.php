<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManpowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('detalle_id');
            $table->unsignedBigInteger('contratista_id');
            $table->boolean('finalizado')->default(0);
            $table->dateTime('agendado_desde');
            $table->dateTime('agendado_hasta');
            $table->dateTime('trabajado_desde')->nullable();
            $table->dateTime('trabajado_hasta')->nullable();
            $table->mediumText('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('detalle_id')->references('id')->on('detalle_tickets');
            $table->foreign('contratista_id')->references('id')->on('contratistas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manpowers');
    }
}
