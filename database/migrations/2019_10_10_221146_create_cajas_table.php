<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre_Caja');
            $table->string('Forma_Cobro');
            $table->enum('Estado', ['ABIERTA','CERRADA']);
            $table->string('Terminal')->unique()->nullable();
            $table->decimal('Monto_Inicial', 20, 2)->nullable();
            $table->decimal('Monto_Final', 20, 2)->nullable();
            $table->text('Descripcion')->nullable();
            $table->dateTime('Fecha_Hora_Apertura')->nullable();
            $table->dateTime('Fecha_Hora_Cierre')->nullable();
            $table->string('Campo_Extra_1')->nullable();
            $table->string('Campo_Extra_2')->nullable();
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
        Schema::dropIfExists('cajas');
    }
}
