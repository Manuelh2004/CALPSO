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
        Schema::create('item_menu', function (Blueprint $table) {
            $table->id('id_item_menu');
            $table->integer('id_categoria');
            $table->string('nombre_item', 100)->unique(); // Nombre de item único
            $table->text('descripcion')->nullable();
            $table->decimal('precio_item', 10, 2)->check('precio_item >= 0'); // Precio positivo
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
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
        Schema::dropIfExists('item_menu');
    }
};
