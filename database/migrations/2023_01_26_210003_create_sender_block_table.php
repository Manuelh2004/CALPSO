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
        Schema::create('sender_block', function (Blueprint $table) {
            $table->bigIncrements('sb_id');
            $table->integer('block_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->timestamp('sb_date_start')->nullable();
            $table->timestamp('sb_date_finish')->nullable();
            $table->integer('sb_status')->nullable();
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
        Schema::dropIfExists('sender_block');
    }
};
