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
            $table->integer('Id_ItemMenu');
            $table->integer('Id_Insumo');
            $table->integer('Cantidad')->default(0);
            $table->timestamps();
            // Clave primaria compuesta
            $table->primary(['Id_ItemMenu', 'Id_Insumo']);
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
