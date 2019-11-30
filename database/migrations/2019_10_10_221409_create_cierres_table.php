<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Caja_Id');
            $table->foreign('Caja_Id')->references('id')->on('cajas');
            $table->unsignedBigInteger('Empleado_Id');
            $table->foreign('Empleado_Id')->references('id')->on('empleados');
            $table->dateTime('Fecha_Hora_Cierre');
            $table->decimal('Total_Final_Sistema', 20, 2);
            $table->decimal('Total_Final_Real', 20, 2);
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
        Schema::dropIfExists('cierres');
    }
}
