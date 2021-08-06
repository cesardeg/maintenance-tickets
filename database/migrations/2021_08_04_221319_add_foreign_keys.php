<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('cat', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('contratistas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function ($table) {
            $table->dropForeign('clientes_user_id_foreign');
        });

        Schema::table('cat', function ($table) {
            $table->dropForeign('cat_user_id_foreign');
        });

        Schema::table('contratistas', function ($table) {
            $table->dropForeign('contratistas_user_id_foreign');
        });
    }
}
