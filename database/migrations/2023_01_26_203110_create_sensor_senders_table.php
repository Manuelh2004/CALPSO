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
        Schema::create('sensor_sender', function (Blueprint $table) {
            $table->bigIncrements('ss_id');
            $table->integer('sensor_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('slot_id')->nullable();
            $table->string('ss_channel',10)->nullable();
            $table->text('ss_config')->nullable();
            $table->integer('ss_status')->nullable();
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
        Schema::dropIfExists('sensor_senders');
    }
};
