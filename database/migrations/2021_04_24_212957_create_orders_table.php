<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable(); //Usuario
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //Datos de productos de pedido
            $table->text('nombre')->nullable();
            $table->text('foto')->nullable();
            $table->text('presentacion')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
            $table->decimal('cantidad', 8, 2)->nullable();
            $table->text('tipo')->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
