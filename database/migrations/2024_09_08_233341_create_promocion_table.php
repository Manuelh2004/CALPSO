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
        Schema::create('promocion', function (Blueprint $table) {
            $table->id('Id_Promocion');
            $table->string('NombrePromocion', 100)->unique(); // Nombre único
            $table->text('DescripcionPromocion')->nullable();
            $table->date('FechaInicio');
            $table->date('FechaFin');
            $table->enum('EstadoPromocion', ['activo', 'inactivo'])->default('activo');
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
        Schema::dropIfExists('promocion');
    }
};
