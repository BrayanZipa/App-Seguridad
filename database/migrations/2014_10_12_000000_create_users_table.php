<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_usuarios', function (Blueprint $table) {
            $table->increments('id_usuarios');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('tittle')->nullable();
            $table->string('username')->nullable();
            $table->string('identification')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('se_usuarios');
    }
}
