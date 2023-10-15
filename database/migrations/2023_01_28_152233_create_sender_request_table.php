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
        Schema::create('sender_request', function (Blueprint $table) {
            $table->bigIncrements('sr_id');
            $table->string('sender_serial',50)->nullable();
            $table->integer('sender_id')->nullable();
            $table->text('sr_content_request')->nullable();
            $table->string('sr_user_agent',50)->nullable();
            $table->string('sr_auth',50)->nullable();
            $table->timestamp('sr_datetime_sender')->nullable();
            $table->text('sr_header')->nullable();
            $table->string('psis_sr_status',7)->nullable()->comment("psis_type_code 000004");
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
        Schema::dropIfExists('sender_request');
    }
};
