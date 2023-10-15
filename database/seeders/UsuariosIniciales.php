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
            ],[
                // 'user_id' => 3,
                'name' => 'sunass',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 4,
                'name' => 'bid',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 5,
                'name' => 'wf1301',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 6,
                'name' => 'wf1302',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 7,
                'name' => 'wf1303',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 8,
                'name' => 'wf1304',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 9,
                'name' => 'wf1305',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 10,
                'name' => 'wf1306',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 11,
                'name' => 'wf1307',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 12,
                'name' => 'wf1308',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 13,
                'name' => 'wf1309',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 14,
                'name' => 'wf1310',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 15,
                'name' => 'wf1311',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 16,
                'name' => 'wf1312',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 17,
                'name' => 'wf1313',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 18,
                'name' => 'wf1314',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 19,
                'name' => 'wf1315',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 20,
                'name' => 'wf1316',
                'password' => '$2a$12$YBIHm0cTkJMvGq0aJubSuO7tZ1wa0Ueo52uVBGO./mn9NEOdec7FO',//sunass2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 21,
                'name' => 'wf1402',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 22,
                'name' => 'wf1403',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 23,
                'name' => 'wf1404',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 24,
                'name' => 'wf1405',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'user_id' => 25,
                'name' => 'wf1406',
                'password' => '$2a$12$fEJx2t1moa5o8Hr85Ted0uGgmfePjyo8edi7qcJKbepeoDvoHvQ8C',//bid2023
                'psis_user_role' => '000021',
                'user_creator' => 1,
                'user_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
