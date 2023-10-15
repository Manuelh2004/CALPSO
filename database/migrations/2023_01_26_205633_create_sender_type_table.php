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
        Schema::create('sender_type', function (Blueprint $table) {
            $table->bigIncrements('st_id');
            $table->string('st_name')->nullable();
            $table->string('st_model')->nullable();
            $table->string('st_brand')->nullable();
            $table->string('st_codename')->nullable();
            $table->integer('st_status')->default(1);
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
        Schema::dropIfExists('sender_type');
    }
};
