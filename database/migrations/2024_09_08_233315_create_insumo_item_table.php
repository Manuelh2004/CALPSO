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
        Schema::create('insumo_item', function (Blueprint $table) {
            $table->integer('id_item_menu');
            $table->integer('id_insumo');
            $table->integer('cantidad')->default(0);
            $table->timestamps();
            // Clave primaria compuesta
            $table->primary(['id_item_menu', 'id_insumo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumo_item');
    }
};
