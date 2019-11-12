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
            $table->unsignedBigInteger('detail_id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            $table->text('dosis')->nullable();
            $table->date('fecha')->nullable();
            $table->enum('verificado', ['OK', 'PENDIENTE','PROCESO'])->default('PENDIENTE');
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //RELATIONS
            $table->foreign('detail_id')->references('id')->on('details')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
