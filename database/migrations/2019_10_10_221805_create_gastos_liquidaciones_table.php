<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosLiquidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_liquidaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Gasto_Id');
            $table->foreign('Gasto_Id')->references('id')->on('gastos');
            $table->unsignedBigInteger('Liquidacion_Id');
            $table->foreign('Liquidacion_Id')->references('id')->on('liquidaciones');
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
        Schema::dropIfExists('gastos_liquidaciones');
    }
}
