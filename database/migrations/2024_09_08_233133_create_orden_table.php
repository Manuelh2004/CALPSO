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
        Schema::create('orden', function (Blueprint $table) {
            $table->id('id_orden');
            $table->integer('id_cliente');
            $table->integer('id_empleado');
            $table->integer('id_sucursal');
            $table->date('fecha_orden');
            $table->decimal('total_orden', 10, 2);
            $table->unsignedTinyInteger('estado')->nullable()->default(1);
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
        Schema::dropIfExists('orden');
    }
};
