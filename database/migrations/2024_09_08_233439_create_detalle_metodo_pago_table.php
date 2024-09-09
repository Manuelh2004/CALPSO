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
            $table->id('Id_DetalleMetodoPago');
            $table->integer('Id_MetodoPago');
            $table->integer('Id_ComprobantePago');
            $table->decimal('Monto', 10, 2)->check('Monto > 0'); // Monto positivo
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
