<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_id');
            $table->integer('pregunta_1')->nullable();
            $table->integer('pregunta_2')->nullable();
            $table->integer('pregunta_3')->nullable();
            $table->integer('pregunta_4')->nullable();
            $table->integer('pregunta_5')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();


            //Foreign Keys
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuestas');
    }
}
