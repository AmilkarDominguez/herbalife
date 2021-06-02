<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('codigo')->nullable();
            $table->text('nombre')->nullable();
            $table->text('desayuno')->nullable();
            $table->text('merienda_am')->nullable();
            $table->text('almuerzo')->nullable();
            $table->text('merienda_pm')->nullable();
            $table->text('cena')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
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
        Schema::dropIfExists('diets');
    }
}
