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
            $table->id('id_detalle_orden');
            $table->integer('id_orden');
            $table->integer('id_item_menu');
            $table->integer('cantidad')->unsigned()->default(1)->check('Cantidad > 0'); // Cantidad positiva
            $table->decimal('sub_total_orden', 10, 2)->check('sub_total_orden >= 0'); // Subtotal positivo
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
