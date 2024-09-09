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
            $table->id('Id_Cliente');
            $table->integer('Id_TipoCliente');
            $table->string('NombreCliente', 100);
            $table->enum('Genero', ['M', 'F']);
            $table->unsignedTinyInteger('Edad');
            $table->string('Telefono', 9)->unique(); // Especifica longitud, por ejemplo, 15 caracteres
            $table->enum('Estado', ['activo', 'inactivo'])->default('activo'); // Valor predeterminado 'activo'
            $table->string('Password');
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
