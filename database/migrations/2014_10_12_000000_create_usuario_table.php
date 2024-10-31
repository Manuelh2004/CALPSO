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
            $table->integer('id_cargo');
            $table->integer('id_tipo');
            $table->integer('id_area');
            $table->integer('id_sucursal')->nullable();
            $table->string('nombre',200)->nullable();
            $table->string('apellido',200)->nullable();
            $table->unsignedTinyInteger('edad')->nullable();
            $table->string('correo')->nullable()->unique();
            $table->enum('genero', ['M', 'F'])->nullable();
            $table->string('name')->unique();
            $table->string('password');
            $table->timestamp("usuario_fecha_expiracion")->nullable();
            $table->integer('usuario_login_intentos')->nullable();
            $table->string("psis_rol_usuario", 7)->nullable()->comment('psis_type_code 000001');
            $table->unsignedTinyInteger('estado')->nullable()->default(1);
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
