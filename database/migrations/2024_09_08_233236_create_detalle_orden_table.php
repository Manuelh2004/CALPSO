<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden', function (Blueprint $table) {
            $table->id('Id_DetalleOrden');
            $table->integer('Id_Orden');
            $table->integer('Id_ItemMenu');
            $table->integer('Cantidad')->unsigned()->default(1)->check('Cantidad > 0'); // Cantidad positiva
            $table->decimal('SubTotalOrden', 10, 2)->check('SubTotalOrden >= 0'); // Subtotal positivo
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
        Schema::dropIfExists('detalle_orden');
    }
};
