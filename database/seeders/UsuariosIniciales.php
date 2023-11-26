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


        DB::table('user_table')->insert([
            [
                // 'user_id' => 1,
                'name' => 'admin',
                'password' => '$2y$10$zESdiGWxQC6A2GF7aS2VXu8tM1v7lVDB.fROSy0zTyXeWeo2M0GKe',//admin
                'psis_user_role' => '000023',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 2,
                'name' => 'free',
                'password' => '$2y$10$zESdiGWxQC6A2GF7aS2VXu8tM1v7lVDB.fROSy0zTyXeWeo2M0GKe',//admin
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
