<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_cat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lunes_i')->nullable();
            $table->string('lunes_t')->nullable();
            $table->string('martes_i')->nullable();
            $table->string('martes_t')->nullable();
            $table->string('mier_i')->nullable();
            $table->string('mier_t')->nullable();
            $table->string('jueves_i')->nullable();
            $table->string('jueves_t')->nullable();
            $table->string('viernes_i')->nullable();
            $table->string('viernes_t')->nullable();
            $table->string('sabado_i')->nullable();
            $table->string('sabado_t')->nullable();
            $table->string('domingo_i')->nullable();
            $table->string('domingo_t')->nullable();
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
        Schema::dropIfExists('agenda_cat');
    }
}
