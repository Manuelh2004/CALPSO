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
        Schema::create('webhook_service', function (Blueprint $table) {
            $table->bigIncrements('ws_id');
            $table->string('ws_url',300)->nullable();
            $table->string('ws_token',500)->nullable();
            $table->text('ws_auth_parameters')->nullable();
            $table->string('ws_auth_url',300)->nullable();
            $table->timestamp('ws_token_expire')->nullable();
            $table->integer('ws_status')->nullable();
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
        Schema::dropIfExists('webhook_service');
    }
};
