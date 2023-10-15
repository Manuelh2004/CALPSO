<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\ParameterSystem;

class PSISSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        ParameterSystem::truncate();

        //block.id = 1
        DB::table('parameter_system')->insert([
            [
                'psis_code' => '000001',
                'psis_type_code' => '000001',
                'psis_value' => 'ESTACION',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000002',
                'psis_type_code' => '000001',
                'psis_value' => 'PROCESO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000003',
                'psis_type_code' => '000001',
                'psis_value' => 'PLANTA',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000004',
                'psis_type_code' => '000001',
                'psis_value' => 'RIO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000005',
                'psis_type_code' => '000001',
                'psis_value' => 'CUENCA',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000006',
                'psis_type_code' => '000001',
                'psis_value' => 'DISTRITO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000007',
                'psis_type_code' => '000001',
                'psis_value' => 'DEPARTAMENTO',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000008',
                'psis_type_code' => '000001',
                'psis_value' => 'REGION',
                'psis_order' => 4,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000009',
                'psis_type_code' => '000005',
                'psis_value' => 'OBSERVADOR',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000010',
                'psis_type_code' => '000005',
                'psis_value' => 'MANTENIMIENTO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000011',
                'psis_type_code' => '000005',
                'psis_value' => 'ADMINISTRADOR',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000012',
                'psis_type_code' => '000003',
                'psis_value' => 'DNI',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000013',
                'psis_type_code' => '000003',
                'psis_value' => 'RUC',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000014',
                'psis_type_code' => '000003',
                'psis_value' => 'DOCUMENTO EXTRANJERIA',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000015',
                'psis_type_code' => '000003',
                'psis_value' => 'PASAPORTE',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000016',
                'psis_type_code' => '000001',
                'psis_value' => 'PROYECTO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000017',
                'psis_type_code' => '000004',
                'psis_value' => 'REGISTRADO',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000018',
                'psis_type_code' => '000004',
                'psis_value' => 'NO ENCONTRADO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000019',
                'psis_type_code' => '000004',
                'psis_value' => 'NO HABILITADO',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000020',
                'psis_type_code' => '000004',
                'psis_value' => 'NO VALIDO',
                'psis_order' => 4,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000021',
                'psis_type_code' => '000002',
                'psis_value' => 'USUARIO',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000022',
                'psis_type_code' => '000002',
                'psis_value' => 'ORGANIZACION',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000023',
                'psis_type_code' => '000002',
                'psis_value' => 'ADMINISTRADOR',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000024',
                'psis_type_code' => '000006',
                'psis_value' => 'NORMAL',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000025',
                'psis_type_code' => '000006',
                'psis_value' => 'RIESGO',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000026',
                'psis_type_code' => '000006',
                'psis_value' => 'PELIGRO',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000027',
                'psis_type_code' => '000006',
                'psis_value' => 'DESCONECTADO',
                'psis_order' => 4,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000028',
                'psis_type_code' => '000006',
                'psis_value' => 'ERROR',
                'psis_order' => 5,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
