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
            $table->id('Id_ComprobantePago');
            $table->integer('Id_Empleado');
            $table->integer('Id_Sucursal');
            $table->integer('Id_MetodoEntrega');
            $table->integer('Id_Promocion');
            $table->integer('Id_Cliente');
            $table->integer('Id_TipoComprobante');
            $table->integer('Id_Orden');
            $table->date('FechaComprobante');
            $table->decimal('TotalComprobante', 10, 2)->check('TotalComprobante >= 0'); // Total positivo con dos decimales
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
