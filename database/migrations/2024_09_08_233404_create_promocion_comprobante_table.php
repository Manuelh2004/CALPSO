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
        Schema::create('promocion_comprobante', function (Blueprint $table) {
            $table->integer('id_comprobante_pago');
            $table->integer('id_promocion');
            $table->decimal('monto_descuento', 8, 2)->check('monto_descuento >= 0'); // Descuento positivo
            $table->timestamps();
            // Clave primaria compuesta
            $table->primary(['id_comprobante_pago', 'id_promocion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocion_comprobante');
    }
};
