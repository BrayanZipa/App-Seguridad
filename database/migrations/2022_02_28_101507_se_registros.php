<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_registros', function (Blueprint $table) {
            $table->increments('id_registros');
            $table->unsignedInteger('id_persona');
            $table->foreign('id_persona')->references('id_personas')->on('se_personas');
            $table->dateTime('ingreso_persona');
            $table->dateTime('salida_persona')->nullable();
            $table->dateTime('ingreso_vehiculo')->nullable();
            $table->dateTime('salida_vehiculo')->nullable();
            $table->unsignedInteger('id_vehiculo')->nullable();
            $table->foreign('id_vehiculo')->references('id_vehiculos')->on('se_vehiculos');
            $table->dateTime('ingreso_activo')->nullable();
            $table->dateTime('salida_activo')->nullable();
            $table->string('codigo_activo', 5)->nullable();
            $table->string('codigo_activo_salida', 5)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->unsignedInteger('empresa_visitada')->nullable();
            $table->foreign('empresa_visitada')->references('id_empresas')->on('se_empresas');  
            $table->string('colaborador', 50)->nullable();
            $table->string('ficha', 3)->nullable();
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuarios')->on('se_usuarios');      
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
        Schema::dropIfExists('se_registros');
    }
}
