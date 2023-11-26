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
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('usuario_id');
            $table->string('usuario_name')->unique();
            $table->string('usuario_email')->nullable();
            $table->string('usuario_password');
            $table->integer('usuario_estado')->nullable();
            $table->integer('usuario_login_intentos')->nullable();
            $table->timestamp("usuario_fecha_expiracion")->nullable();
            $table->integer('usuario_creador')->nullable();
            $table->string("psis_rol_usuario", 7)->nullable()->comment('psis_type_code 000002');
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
