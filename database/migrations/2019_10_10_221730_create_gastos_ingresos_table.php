<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Gasto_Id');
            $table->foreign('Gasto_Id')->references('id')->on('gastos');
            $table->unsignedBigInteger('Ingreso_Id');
            $table->foreign('Ingreso_Id')->references('id')->on('ingresos');
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
        Schema::dropIfExists('gastos_ingresos');
    }
}
