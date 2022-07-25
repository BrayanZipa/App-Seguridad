<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_vehiculos', function (Blueprint $table) {
            $table->increments('id_vehiculos');
            $table->string('identificador', 15)->unique();
            $table->unsignedInteger('id_tipo_vehiculo');  
            $table->foreign('id_tipo_vehiculo')->references('id_tipo_vehiculos')->on('se_tipo_vehiculos');
            $table->unsignedInteger('id_marca_vehiculo')->nullable();  
            $table->foreign('id_marca_vehiculo')->references('id_marca_vehiculos')->on('se_marca_vehiculos');
            $table->string('foto_vehiculo', 100)->nullable();
            $table->unsignedInteger('id_usuario');  
            $table->foreign('id_usuario')->references('id_usuarios')->on('se_usuarios');
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('se_vehiculos');
    }
}
