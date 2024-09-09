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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('Id_Empleado');
            $table->integer('Id_Cargo');
            $table->integer('Id_Tipo');
            $table->integer('Id_Area');
            $table->integer('Id_Sucursal');
            $table->string('NombreEmpleado',200);
            $table->unsignedTinyInteger('Edad');
            $table->string('CorreoElectronico')->unique();
            $table->enum('Genero', ['M', 'F']);
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
        Schema::dropIfExists('empleado');
    }
};
