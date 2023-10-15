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
        Schema::create('webhook_historical', function (Blueprint $table) {
            $table->bigIncrements('wh_id');
            $table->integer('wr_id')->nullable();
            $table->integer('sr_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('wh_http_status')->nullable();
            $table->text('wh_http_response')->nullable();
            $table->integer('wh_status')->nullable();
            $table->integer('wh_external_id')->nullable();
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
        Schema::dropIfExists('webhook_historical');
    }
};
