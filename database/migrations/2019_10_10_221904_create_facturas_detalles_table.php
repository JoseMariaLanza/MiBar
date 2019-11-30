<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Factura_Id');
            $table->foreign('Factura_Id')->references('id')->on('facturas');
            $table->unsignedBigInteger('Orden_Id')->nullable();
            $table->foreign('Orden_Id')->references('id')->on('ordenes');
            $table->decimal('Precio_Unitario', 20, 2);
            $table->decimal('Cantidad', 20, 3);
            $table->decimal('Subtotal', 20, 2);
            $table->text('Descripcion');
            // $table->enum('Estado', ['EN PREPARACIÓN', 'PREPARADA', 'ENTREGADA', 'FACTURADA', 'ANULADA']);
            $table->enum('Estado', ['REGISTRADA', 'ANULADA']);
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
        Schema::dropIfExists('facturas_detalles');
    }
}
