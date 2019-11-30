<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Caja_Id')->nullable(); // Luego será obligación ingresar el id de la caja en este campo
            $table->foreign('Caja_Id')->references('id')->on('cajas');
            $table->unsignedBigInteger('Usuario_Id')->nullable(); // luego también será obligatorio
            $table->foreign('Usuario_Id')->references('id')->on('users');
            $table->integer('Serie')->nullable(); // implementar incremento 0001 - 9998 (4 dígitos)
            $table->integer('Numero')->nullable(); // implementar incremento 00000001 - 99999999 (8 dígitos)
            $table->string('Tipo');
            $table->unsignedBigInteger('Cliente_Id')->nullable();
            $table->foreign('Cliente_Id')->references('id')->on('clientes');
            $table->dateTime('Fecha_Emision');
            $table->enum('Estado', ['EN EMISIÓN', 'FACTURADA', 'ANULADA']);
            $table->enum('Forma_Pago', [null, 'EFECTIVO', 'TARJETA'])->nullable();
            $table->decimal('Total', 20, 2);
            $table->text('Descripcion')->nullable();
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
        Schema::dropIfExists('facturas');
    }
}
