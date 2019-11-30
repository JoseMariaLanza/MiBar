<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promociones_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('Promocion_Id');
            $table->foreign('Promocion_Id')->references('id')->on('promociones');
            $table->unsignedBigInteger('Item_Id'); // Id de la tabla Menu
            $table->foreign('Item_Id')->references('id')->on('menus');
            $table->decimal('Precio_Venta_Promo', 20, 2);
            $table->decimal('Cantidad', 20, 3);
            $table->decimal('Subtotal', 20, 2);
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
        Schema::dropIfExists('promociones_menus');
    }
}
