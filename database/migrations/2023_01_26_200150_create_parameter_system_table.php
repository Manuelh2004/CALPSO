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
        Schema::create('parameter_system', function (Blueprint $table) {
            $table->string('psis_code',7);
            $table->string('psis_type_code',7);
            $table->string('psis_value',200)->nullable();
            $table->decimal('psis_order',10,2)->nullable();
            $table->integer('user_creator_id')->nullable();
            $table->integer('psis_status')->default(1);
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
        Schema::dropIfExists('parameter_system');
    }
};
