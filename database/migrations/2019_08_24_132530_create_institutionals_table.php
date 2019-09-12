<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            //Custom
            $table->text('vision')->nullable();
            $table->text('mision')->nullable();
            $table->text('direccion')->nullable();
            $table->text('telefono')->nullable();
            $table->text('web')->nullable();
            $table->text('email')->nullable();
            $table->text('contacto')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->timestamps();
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('institutionals');
    }
}
