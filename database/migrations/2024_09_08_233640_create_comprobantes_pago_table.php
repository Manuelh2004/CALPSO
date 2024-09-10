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
        Schema::create('comprobantes_pago', function (Blueprint $table) {
            $table->id('id_comprobante_pago');
            $table->integer('id_empleado');
            $table->integer('id_sucursal');
            $table->integer('id_metodo_entrega');
            $table->integer('id_promocion');
            $table->integer('id_cliente');
            $table->integer('id_tipo_comprobante');
            $table->integer('id_orden');
            $table->date('fecha_comprobante');
            $table->decimal('total_comprobante', 10, 2)->check('TotalComprobante >= 0'); // Total positivo con dos decimales
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
        Schema::dropIfExists('comprobantes_pago');
    }
};
