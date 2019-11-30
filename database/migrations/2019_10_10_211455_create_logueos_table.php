<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logueos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('User_Id');
            $table->foreign('User_Id')->references('id')->on('users');
            $table->dateTime('Fecha_Hora_Login');
            $table->dateTime('Fecha_Hora_Logout');
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
        Schema::dropIfExists('logueos');
    }
}
