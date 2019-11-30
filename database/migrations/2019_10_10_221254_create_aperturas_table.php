<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAperturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Caja_Id');
            $table->foreign('Caja_Id')->references('id')->on('cajas');
            $table->unsignedBigInteger('Empleado_Id');
            $table->foreign('Empleado_Id')->references('id')->on('empleados');
            $table->dateTime('Fecha_Hora_Apertura');
            $table->decimal('Total', 20, 2); // Es el monto en $$ con el que inicia la caja
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
        Schema::dropIfExists('aperturas');
    }
}
