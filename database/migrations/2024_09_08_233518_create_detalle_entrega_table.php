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
        Schema::create('detalle_entrega', function (Blueprint $table) {
            $table->id('id_detalle_entrega');
            $table->integer('id_metodo_entrega');
            $table->string('direccion_entrega', 255);
            $table->unsignedTinyInteger('estado')->nullable()->default(1);
            $table->text('comentario')->nullable();
            $table->date('fecha');
            $table->time('hora');
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
        Schema::dropIfExists('detalle_entrega');
    }
};
