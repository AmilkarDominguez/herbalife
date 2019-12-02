<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejecutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //Custom
            $table->unsignedBigInteger('plan_id')->unsigned()->nullable();
            $table->unsignedBigInteger('client_id')->unsigned()->nullable();//Usuario
            $table->date('fecha')->nullable();
            $table->enum('verificado', ['REALIZADO', 'PENDIENTE','VENCIDO'])->default('PENDIENTE');
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //RELATIONS
            $table->foreign('plan_id')->references('id')->on('plans')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejecutions');
    }
}
