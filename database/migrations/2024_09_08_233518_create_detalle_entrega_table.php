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
        Schema::create('detalle_entrega', function (Blueprint $table) {
            $table->id('Id_DetalleEntrega');
            $table->integer('Id_MetodoEntrega');
            $table->string('DireccionEntrega', 255);
            $table->enum('Estado', ['activo', 'inactivo'])->default('activo'); // Valor predeterminado 'activo'
            $table->text('Comentario')->nullable();
            $table->date('Fecha');
            $table->time('Hora');
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
        Schema::dropIfExists('detalle_entrega');
    }
};
