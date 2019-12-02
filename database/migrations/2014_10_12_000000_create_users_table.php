<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->rememberToken();
            $table->timestamps();
            //Custom
            $table->enum('state_rol', ['ADMINISTRADOR', 'ASESOR','CLIENTE'])->default('CLIENTE');
            $table->text('foto')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('sexo')->nullable();
            $table->text('estatura')->nullable();
            $table->text('peso')->nullable();
            $table->text('direccion')->nullable();
            $table->text('codigo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
