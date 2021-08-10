<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedAditionalCommentsTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->mediumText('observacion_fin')->nullable()->after('prototipo');
        });

        Schema::table('detalle_tickets', function (Blueprint $table) {
            $table->mediumText('descripcion')->nullable()->after('ubicacion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('observacion_finalizacion');
        });

        Schema::table('detalle_tickets', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
