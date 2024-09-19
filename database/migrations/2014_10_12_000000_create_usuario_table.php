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
            $table->string('name')->unique();
            $table->string('password');
            $table->timestamp("usuario_fecha_expiracion")->nullable();
            $table->integer('usuario_login_intentos')->nullable();
            $table->string("psis_rol_usuario", 7)->nullable()->comment('psis_type_code 000001');
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
        Schema::dropIfExists('usuario');
    }
}
