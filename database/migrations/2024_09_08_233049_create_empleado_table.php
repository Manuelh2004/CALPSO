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
            $table->id('id_empleado');
            $table->integer('id_cargo');
            $table->integer('id_tipo');
            $table->integer('id_area');
            $table->integer('id_sucursal');
            $table->string('nombre_empleado',200);
            $table->unsignedTinyInteger('edad');
            $table->string('correo_electronico')->unique();
            $table->enum('genero', ['M', 'F']);
            $table->unsignedTinyInteger('estado')->nullable()->default(1);
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
        Schema::dropIfExists('empleado');
    }
};
