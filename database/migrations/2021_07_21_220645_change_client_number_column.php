<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeClientNumberColumn extends Migration
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
            $table->string('numero_cliente')->change();
            $table->string('coopropietario')->nullable()->change();
            $table->unique('numero_cliente', 'numero_cliente_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('numero_cliente')->change();
            $table->string('coopropietario')->change();
            $table->dropUnique('numero_cliente_unique');
        });
    }
}
