<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_table', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name')->unique();
            $table->string('password');
            $table->integer('user_status')->nullable();
            $table->string('user_email')->nullable();
            $table->timestamp("expiration_date")->nullable();
            $table->integer('user_creator')->nullable();
            $table->string("psis_user_role", 7)->nullable()->comment('psis_type_code 000002');
            $table->timestamp("email_verified_at")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user_table');
    }
}
