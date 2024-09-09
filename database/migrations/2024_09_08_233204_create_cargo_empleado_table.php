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
        Schema::create('cargo_empleado', function (Blueprint $table) {
            $table->id('Id_Cargo');
            $table->string('NombreCargo',100);
            $table->text('Descripcion')->nullable();
            $table->decimal('SalarioBase', 10, 2)->default(0.00);
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
        Schema::dropIfExists('cargo_empleado');
    }
};
