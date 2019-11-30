<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Mesa_Id')->nullable();
            $table->foreign('Mesa_Id')->references('id')->on('mesas');
            $table->dateTime('Fecha_Hora_Orden_Entregada');
            $table->enum('Estado_Orden', ['EN PREPARACIÓN', 'PREPARADA', 'ENTREGADA', 'FACTURADA']);
            $table->enum('Estado_Mesa', ['LIBRE', 'OCUPADA', 'RESERVADA']);
            $table->dateTime('Fecha_Hora_Orden_Finalizada')->nullable();
            $table->decimal('Total', 20, 2);
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
        Schema::dropIfExists('ordenes');
    }
}
