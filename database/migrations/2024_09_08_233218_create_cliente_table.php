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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->integer('id_tipo_cliente')->default(1);
            $table->string('nombre_cliente', 100);
            $table->enum('genero', ['M', 'F']);
            $table->unsignedTinyInteger('edad');
            $table->string('telefono', 9)->unique(); // Especifica longitud, por ejemplo, 15 caracteres
            $table->enum('estado', ['activo', 'inactivo'])->default('activo'); // Valor predeterminado 'activo'
            $table->string('password');
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
        Schema::dropIfExists('cliente');
    }
};
