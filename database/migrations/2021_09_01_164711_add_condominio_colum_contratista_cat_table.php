<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCondominioColumContratistaCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat', function (Blueprint $table) {
            $table->unsignedBigInteger('condominio_id')->nullable()->after('proyecto');

            $table->foreign('condominio_id')->references('id')->on('condominios');
        });

        Schema::table('contratistas', function (Blueprint $table) {
            $table->unsignedBigInteger('condominio_id')->nullable()->after('proyecto');
            $table->unsignedBigInteger('cat_id')->nullable()->after('coordinador');

            $table->foreign('condominio_id')->references('id')->on('condominios');
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
        Schema::table('cat', function (Blueprint $table) {
            $table->dropForeign('cat_condominio_id_foreign');

            $table->dropColumn('condominio_id');
        });

        Schema::table('contratistas', function (Blueprint $table) {

            $table->dropForeign('contratistas_condominio_id_foreign');
    
            $table->dropColumn('condominio_id');
        });
    }
}
