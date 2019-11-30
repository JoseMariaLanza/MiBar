<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas_reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Mesa_Id')->nullable();
            $table->foreign('Mesa_Id')->references('id')->on('mesas');
            $table->unsignedBigInteger('Reserva_Id')->nullable();
            $table->foreign('Reserva_Id')->references('id')->on('reservas');
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
        Schema::dropIfExists('mesas_reservas');
    }
}
