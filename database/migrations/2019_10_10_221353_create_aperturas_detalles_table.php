<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAperturasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperturas_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Apertura_Id');
            $table->foreign('Apertura_Id')->references('id')->on('aperturas');
            $table->string('Moneda');
            $table->decimal('Denominacion', 20, 2);
            $table->decimal('Cantidad', 20, 3);
            $table->decimal('Subtotal', 20, 2);
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
        Schema::dropIfExists('aperturas_detalles');
    }
}
