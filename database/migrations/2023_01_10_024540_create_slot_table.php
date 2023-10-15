<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot', function (Blueprint $table) {
            $table->increments('slot_id');
            $table->integer('parameter_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('sensor_id')->nullable();
            $table->decimal('up_danger_limit', 10, 4)->nullable();
            $table->decimal('up_risk_limit', 10, 4)->nullable();
            $table->decimal('down_risk_limit', 10, 4)->nullable();
            $table->decimal('down_danger_limit', 10, 4)->nullable();
            $table->decimal('slot_last_value', 10, 4)->nullable();
            $table->integer('slot_average_limit_state')->nullable();
            $table->decimal('slot_average_value', 10, 4)->nullable();
            $table->text('slot_config')->nullable();
            $table->integer('slot_status')->nullable();
            $table->integer('slot_visible')->default(1);
            $table->integer('slot_supervise')->default(0);
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
        Schema::dropIfExists('slot');
    }
}
