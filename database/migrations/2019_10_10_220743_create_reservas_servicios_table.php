<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Reserva_Id')->nullable();
            $table->foreign('Reserva_Id')->references('id')->on('reservas');
            $table->unsignedBigInteger('Servicio_Id')->nullable();
            $table->foreign('Servicio_Id')->references('id')->on('servicios');
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
        Schema::dropIfExists('reservas_servicios');
    }
}
