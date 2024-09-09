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
        Schema::create('metodo_entrega', function (Blueprint $table) {
            $table->id('Id_MetodoEntrega');
            $table->string('NombreMetodoEntrega', 100)->unique(); // Método de entrega único
            $table->decimal('Costo', 10, 2)->default(0)->check('Costo >= 0'); // Costo no negativo
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
        Schema::dropIfExists('metodo_entrega');
    }
};
