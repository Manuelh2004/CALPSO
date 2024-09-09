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
        Schema::create('tipo_cliente', function (Blueprint $table) {
            $table->id('Id_TipoCliente');
            $table->string('NombreTipo', 50);
            $table->text('Descripcion')->nullable();
            $table->decimal('DescuentoAsociado', 5, 2)->default(0.00);
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
        Schema::dropIfExists('tipo_cliente');
    }
};
