<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Sector_Id')->nullable();
            $table->bigInteger('Numero')->nullable();
            $table->enum('Estado', ['OCUPADA', 'RESERVADA', 'LIBRE']);
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
        Schema::dropIfExists('mesas');
    }
}
