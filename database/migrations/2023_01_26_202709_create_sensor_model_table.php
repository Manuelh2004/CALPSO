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
        Schema::create('sensor_model', function (Blueprint $table) {
            $table->bigIncrements('sm_id');
            $table->string('sm_name')->nullable();
            $table->string('sm_codename')->nullable();
            $table->string('sm_brand')->nullable();
            $table->string('sm_model')->nullable();
            $table->integer('parameter_id')->nullable();
            $table->integer('mu_id')->nullable();
            $table->decimal('sm_max_limit',10,4)->nullable();
            $table->decimal('sm_min_limit',10,4)->nullable();
            $table->integer('sm_status')->default(1);
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
        Schema::dropIfExists('sensor_models');
    }
};
