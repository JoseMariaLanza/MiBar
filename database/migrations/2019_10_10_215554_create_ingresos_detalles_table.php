<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Ingreso_Id');
            $table->foreign('Ingreso_Id')->references('id')->on('ingresos');
            $table->unsignedBigInteger('Articulo_Id')->nullable();
            $table->foreign('Articulo_Id')->references('id')->on('articulos');
            $table->decimal('Precio_Costo', 20, 2);
            $table->decimal('Precio_Venta', 20, 2);
            $table->dateTime('Fecha_Produccion')->nullable();
            $table->dateTime('Fecha_Vencimiento')->nullable();
            $table->decimal('Cantidad', 20, 3);
            $table->decimal('Subtotal', 20, 2);
            // $table->unsignedBigInteger('Ubicacion_Id')->nullable();
            // $table->foreign('Ubicacion_Id')->references('id')->on('ubicaciones')->nullable();
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
        Schema::dropIfExists('ingresos_detalles');
    }
}
