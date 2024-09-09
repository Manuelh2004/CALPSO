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
            $table->integer('Id_Comprobante');
            $table->integer('Id_Promocion');
            $table->decimal('MontoDescuento', 8, 2)->check('MontoDescuento >= 0'); // Descuento positivo
            $table->timestamps();
            // Clave primaria compuesta
            $table->primary(['Id_Comprobante', 'Id_Promocion']);
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
