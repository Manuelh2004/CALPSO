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
            $table->id('Id_ItemMenu');
            $table->integer('Id_Categoria');
            $table->string('NombreItem', 100)->unique(); // Nombre de item único
            $table->text('Descripcion')->nullable();
            $table->decimal('PrecioItem', 10, 2)->check('PrecioItem >= 0'); // Precio positivo
            $table->enum('Estado', ['activo', 'inactivo'])->default('activo');
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
