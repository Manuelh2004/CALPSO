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
        Schema::create('insumo', function (Blueprint $table) {
            $table->id('Id_Insumo');
            $table->string('NombreInsumo', 100)->unique(); // Nombre único
            $table->text('Descripcion')->nullable();
            $table->integer('Stock')->unsigned()->default(0)->check('Stock >= 0'); // Stock no negativo
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
        Schema::dropIfExists('insumo');
    }
};
