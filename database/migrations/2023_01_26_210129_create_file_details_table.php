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
        Schema::create('file_detail', function (Blueprint $table) {
            $table->id('fd_id');
            $table->integer('file_id')->nullable();
            $table->string('fd_url',1000)->nullable();
            $table->string('fd_name',1000)->nullable();
            $table->string('fd_extension',4)->nullable();
            $table->decimal('fd_size',13,4)->nullable();
            $table->integer('fd_status')->default(1);
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
        Schema::dropIfExists('file_detail');
    }
};
