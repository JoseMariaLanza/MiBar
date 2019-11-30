<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('User_Id');
            $table->foreign('User_Id')->references('id')->on('users');
            $table->string('Apellido')->nullable();
            $table->string('Nombre')->nullable();
            $table->dateTime('Fecha_Nacimiento')->nullable();
            $table->string('Telefono')->nullable();
            $table->text('Domicilio')->nullable();
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
        Schema::dropIfExists('empleados');
    }
}
