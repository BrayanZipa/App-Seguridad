<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeActivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_activos', function (Blueprint $table) {
            $table->increments('id_activos');
            $table->string('activo', 20);
            $table->string('codigo', 5)->unique();
            $table->unsignedInteger('id_persona')->unique();
            $table->foreign('id_persona')->references('id_personas')->on('se_personas'); 
            $table->unsignedInteger('id_usuario')->nullable();
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
        Schema::dropIfExists('se_activos');
    }
}
