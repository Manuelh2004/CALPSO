<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsuariosIniciales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = date("Y-m-d h:i:s");
        // https://bcrypt-generator.com/
        User::truncate();


        DB::table('usuario')->insert([
            [
                // 'usuario_id' => 1,
                'name' => 'admin',
                'password' => '$2y$10$zESdiGWxQC6A2GF7aS2VXu8tM1v7lVDB.fROSy0zTyXeWeo2M0GKe',//admin
                'psis_rol_usuario' => '000002',
                'id_area' => 1,
                'id_cargo' => 1,
                'id_tipo' => 1,
                'id_sucursal' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'usuario_id' => 2,
                'name' => 'jota',
                'password' => '$2y$10$zESdiGWxQC6A2GF7aS2VXu8tM1v7lVDB.fROSy0zTyXeWeo2M0GKe',//admin
                'psis_rol_usuario' => '000001',
                'id_area' => 1,
                'id_cargo' => 1,
                'id_tipo' => 1,
                'id_sucursal' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
            ,[
                // 'usuario_id' => 3,
                'name' => 'manu',
                'password' => '$2y$10$zESdiGWxQC6A2GF7aS2VXu8tM1v7lVDB.fROSy0zTyXeWeo2M0GKe',//admin
                'psis_rol_usuario' => '000002',
                'id_area' => 1,
                'id_cargo' => 1,
                'id_tipo' => 1,
                'id_sucursal' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
