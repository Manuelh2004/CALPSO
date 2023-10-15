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
        Schema::create('monitoring_event', function (Blueprint $table) {
            $table->bigIncrements('me_id');
            $table->string('psis_monitoring_status',7)->nullable()->comment('psis_type_code 000006');
            $table->integer('slot_id')->nullable();
            $table->integer('parameter_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('sensor_id')->nullable();
            $table->integer('measurement_id')->nullable();
            $table->string('me_description',300)->nullable();
            $table->decimal('me_limit_value', 13, 4)->nullable();
            $table->integer('me_status')->nullable();
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
        Schema::dropIfExists('monitoring_event');
    }
};
