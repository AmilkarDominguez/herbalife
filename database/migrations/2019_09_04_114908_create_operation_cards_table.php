<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();//Usuario
            //Custom
            $table->text('nit')->nullable();
            $table->text('empresa')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_vigencia')->nullable();
            $table->text('responsable')->nullable();
            $table->text('telefono')->nullable();
            $table->text('email')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->timestamps();
            //RELATIONS
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
        Schema::dropIfExists('operation_cards');
    }
}
