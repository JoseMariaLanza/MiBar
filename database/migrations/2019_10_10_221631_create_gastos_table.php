<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Concepto');
            $table->decimal('Monto', 20, 2);
            $table->enum('Periodo', ['Diario', 'Semanal', 'Mensual', 'Bimestral', 'Trimestral', 'Anual', 'Esporádico', 'No definido', 'Otro']);
            $table->dateTime('Fecha');
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
        Schema::dropIfExists('gastos');
    }
}
