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
        Schema::create('sensor', function (Blueprint $table) {
            $table->bigIncrements('sensor_id');
            $table->integer('sm_id')->nullable();
            $table->string('sensor_codename')->nullable();
            $table->string('sensor_serial',50)->nullable();
            $table->integer('sensor_status')->nullable();
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
        Schema::dropIfExists('sensor');
    }
};
