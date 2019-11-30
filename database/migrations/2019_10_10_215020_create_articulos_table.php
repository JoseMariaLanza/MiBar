<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->unsignedBigInteger('Categoria_Id');
            $table->foreign('Categoria_Id')->references('id')->on('categorias');
            $table->decimal('Precio_Costo', 20, 2);
            $table->decimal('Precio_Venta', 20, 2);
            $table->decimal('Cantidad', 20, 2);
            $table->boolean('Apto_Venta_Unitaria');
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
        Schema::dropIfExists('articulos');
    }
}
