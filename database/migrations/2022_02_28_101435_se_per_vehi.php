<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SePerVehi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_per_vehi', function (Blueprint $table) {
            $table->unsignedInteger('id_persona');  
            $table->foreign('id_persona')->references('id_personas')->on('se_personas');
            $table->unsignedInteger('id_vehiculo');  
            $table->foreign('id_vehiculo')->references('id_vehiculos')->on('se_vehiculos');
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
        Schema::dropIfExists('se_per_vehi');
    }
}
