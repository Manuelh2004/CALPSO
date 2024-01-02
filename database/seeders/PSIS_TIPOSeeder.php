<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\ParameterSystemType;


class PSIS_TIPOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        ParameterSystemType::truncate();

        //block.id = 1
        DB::table('parameter_system_type')->insert([
            [
                'psis_type_code' => '000001',
                'psis_type_description' => 'ROL USUARIO',
                'psis_type_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_type_code' => '000002',
                'psis_type_description' => 'TIPO DE DOCUMENTO',
                'psis_type_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_type_code' => '000003',
                'psis_type_description' => 'ROL ORGANIZACION',
                'psis_type_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_type_code' => '000004',
                'psis_type_description' => 'AREA ORGANIZACION',
                'psis_type_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_type_code' => '000005',
                'psis_type_description' => 'TIPO REGISTRO ASISTENCIA',
                'psis_type_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
