<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->bigIncrements('block_id');
            $table->string('psis_block_type',7)->nullable()->comment('psis_type_code 000001');
            $table->string("block_codename")->nullable();
            $table->string("block_name")->nullable();
            $table->string("block_serial")->nullable();
            $table->integer('parent_block_id')->nullable();
            $table->integer('block_canvas_order')->nullable();
            $table->decimal('block_longitude', 13, 10)->nullable();
            $table->decimal('block_latitude', 13, 10)->nullable();
            $table->decimal('block_altitude', 10, 4)->nullable();
            $table->string("block_description", 500)->nullable();
            $table->string('codigo_ubigeo',10)->nullable();
            $table->integer('file_id_logo')->nullable();
            $table->integer('file_id_image')->nullable();
            $table->integer('block_max_time_offline')->nullable()->comment('tiempo en minutos');
            $table->integer('block_reporting_period')->nullable();
            $table->text("block_config")->nullable();
            $table->integer("block_status")->default(1);
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
        Schema::dropIfExists('block');
    }
}
