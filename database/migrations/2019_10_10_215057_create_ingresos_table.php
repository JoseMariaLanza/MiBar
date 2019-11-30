<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Empleado_Id');
            $table->foreign('Empleado_Id')->references('id')->on('empleados');
            $table->unsignedInteger('Serie');
            $table->unsignedInteger('Numero');
            $table->string('Tipo');
            $table->unsignedBigInteger('Proveedor_Id')->nullable();
            $table->foreign('Proveedor_Id')->references('id')->on('proveedores')->nullable();
            $table->dateTime('Fecha');
            $table->string('Estado');
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
        Schema::dropIfExists('ingresos');
    }
}
