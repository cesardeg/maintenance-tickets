<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedUserCondominioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_condominio', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('condominio_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('condominio_id')->references('id')->on('condominios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_condominio');
    }
}
