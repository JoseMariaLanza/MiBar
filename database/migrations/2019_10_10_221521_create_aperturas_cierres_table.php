<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAperturasCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperturas_cierres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Apertura_Id');
            $table->foreign('Apertura_Id')->references('id')->on('aperturas');
            $table->unsignedBigInteger('Cierre_Id')->nullable();
            $table->foreign('Cierre_Id')->references('id')->on('cierres');
            $table->decimal('Diferencia', 20, 2);
            $table->enum('Estado', ['ABIERTA', 'CERRADA']);
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
        Schema::dropIfExists('aperturas_cierres');
    }
}
