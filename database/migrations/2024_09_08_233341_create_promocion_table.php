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
            $table->id('id_promocion');
            $table->string('nombre_promocion', 100)->unique(); // Nombre único
            $table->text('descripcion_promocion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado_promocion', ['activo', 'inactivo'])->default('activo');
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
