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
        Schema::create('detalle_metodo_pago', function (Blueprint $table) {
            $table->id('id_detalle_metodo_pago');
            $table->integer('id_metodo_pago');
            $table->integer('id_comprobante_pago');
            $table->decimal('monto', 10, 2)->check('monto > 0'); // Monto positivo
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
        Schema::dropIfExists('detalle_metodo_pago');
    }
};
