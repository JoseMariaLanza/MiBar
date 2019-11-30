<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Orden_Id')->nullable();
            $table->foreign('Orden_Id')->references('id')->on('ordenes');
            $table->unsignedBigInteger('Articulo_Id')->nullable();
            $table->foreign('Articulo_Id')->references('id')->on('articulos');
            $table->decimal('Cantidad', 20, 3);
            $table->enum('Estado', ['CANCELADA', 'EN PÉRDIDA']);
            $table->text('Descripcion');
            $table->string('Campo_Extra_1');
            $table->string('Campo_Extra_2');
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
        Schema::dropIfExists('ordenes_articulos');
    }
}
