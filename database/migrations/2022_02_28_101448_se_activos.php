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
            $table->string('codigo', 10)->unique();
            $table->unsignedInteger('id_persona')->unique();
            $table->foreign('id_persona')->references('id_personas')->on('se_personas');  
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
