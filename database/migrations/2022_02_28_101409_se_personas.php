<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SePersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_personas', function (Blueprint $table) {
            $table->increments('id_personas');
            $table->unsignedInteger('id_usuario');  
            $table->foreign('id_usuario')->references('id_usuarios')->on('se_usuarios');
            $table->unsignedInteger('id_tipo_persona');  
            $table->foreign('id_tipo_persona')->references('id_tipo_personas')->on('se_tipo_personas');
            $table->string('nombre', 25);
            $table->string('apellido', 25);
            $table->string('identificacion', 15)->unique();
            $table->unsignedInteger('id_eps')->nullable();
            $table->foreign('id_eps')->references('id_eps')->on('se_eps');
            $table->unsignedInteger('id_arl')->nullable();  
            $table->foreign('id_arl')->references('id_arl')->on('se_arl');
            $table->string('foto', 100);
            $table->string('tel_contacto', 10)->unique();
            $table->string('email', 50)->unique()->nullable();
            $table->unsignedInteger('id_empresa')->nullable();  
            $table->foreign('id_empresa')->references('id_empresas')->on('se_empresas');
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
        Schema::dropIfExists('se_personas');
    }
}
