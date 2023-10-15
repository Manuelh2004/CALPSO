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
        Schema::create('sender', function (Blueprint $table) {
            $table->bigIncrements('sender_id');
            $table->integer('st_id')->nullable();
            $table->string('sender_serial',50)->nullable();
            $table->decimal('sender_energy_level',6,2)->nullable();
            $table->string('sender_sim_number',20)->nullable();
            $table->text('sender_config')->nullable();
            $table->integer('sender_status')->nullable();
            $table->timestamp('sender_last_heart_beat')->nullable();
            $table->integer('sender_max_time_offline')->nullable()->comment("Tiempo en minutos");
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
        Schema::dropIfExists('sender');
    }
};
