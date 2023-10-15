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
        Schema::create('person', function (Blueprint $table) {
            $table->bigIncrements('person_id');
            $table->integer('user_id')->nullable();
            $table->string('psis_document_type',7)->nullable()->comment('psis_type_code 000003');
            $table->string('document_number',20)->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_profile_name')->nullable();
            $table->string('person_lastname')->nullable();
            $table->string('person_phone')->nullable();
            $table->string('person_email')->nullable();
            $table->date('person_birth_date')->nullable();
            $table->string('person_address',300)->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('creator_user_person')->nullable();
            $table->integer('person_status')->nullable();
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
        Schema::dropIfExists('person');
    }
};
