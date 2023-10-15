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
        Schema::create('webhook_report', function (Blueprint $table) {
            $table->bigIncrements('wr_id');
            $table->integer('ws_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('wr_period_report')->nullable()->comment('Tiempo en minutos');
            $table->string('wr_function_report',150)->nullable();
            $table->text('wr_config_parameters')->nullable();
            $table->timestamp('wr_next_report')->nullable();
            $table->integer('wr_status')->nullable();
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
        Schema::dropIfExists('webhook_report');
    }
};
