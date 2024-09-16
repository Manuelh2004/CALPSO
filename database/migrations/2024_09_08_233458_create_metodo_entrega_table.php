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
            $table->id('id_metodo_entrega');
            $table->string('nombre_metodo_entrega', 100)->unique(); // Método de entrega único
            $table->decimal('costo', 10, 2)->default(0)->check('costo >= 0'); // Costo no negativo
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
