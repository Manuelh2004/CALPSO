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
        Schema::create('user_block', function (Blueprint $table) {
            $table->bigIncrements('ub_id');
            $table->integer('user_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->string('psis_ub_role')->nullable()->comment("psis_type_code 000005");
            $table->integer('ub_notification_status')->nullable();
            $table->string('ub_codename')->nullable();
            $table->integer('ub_status')->default(1);
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
        Schema::dropIfExists('user_block');
    }
};
