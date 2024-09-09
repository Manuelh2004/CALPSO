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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id('Id_Sucursal');
            $table->integer('Id_Ciudad');
            $table->string('Direccion',255);
            $table->string('Telefono',9);
            $table->enum('Estado', ['activo', 'inactivo'])->default('activo'); // Valor predeterminado 'activo'
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
        Schema::dropIfExists('sucursal');
    }
};
