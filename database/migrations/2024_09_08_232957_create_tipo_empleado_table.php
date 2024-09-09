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
        Schema::create('tipo_empleado', function (Blueprint $table) {
            $table->id('Id_Tipo');
            $table->string('NombreTipo',50);
            $table->text('Descripcion')->nullable(); //Permitir valores nulos
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
        Schema::dropIfExists('tipo_empleado');
    }
};
