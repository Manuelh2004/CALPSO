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
                'psis_value' => 'USUARIO',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000002',
                'psis_type_code' => '000001',
                'psis_value' => 'ADMINISTRADOR',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000003',
                'psis_type_code' => '000001',
                'psis_value' => 'SUPER USUARIO',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000004',
                'psis_type_code' => '000002',
                'psis_value' => 'DNI',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000005',
                'psis_type_code' => '000002',
                'psis_value' => 'RUC',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000006',
                'psis_type_code' => '000002',
                'psis_value' => 'DOCUMENTO EXTRANJERIA',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000007',
                'psis_type_code' => '000002',
                'psis_value' => 'PASAPORTE',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000008',
                'psis_type_code' => '000003',
                'psis_value' => 'INTEGRANTE',
                'psis_order' => 4,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000009',
                'psis_type_code' => '000003',
                'psis_value' => 'SUPERVISOR',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000010',
                'psis_type_code' => '000003',
                'psis_value' => 'ADMINISTRADOR',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000011',
                'psis_type_code' => '000003',
                'psis_value' => 'PROPIETARIO',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000012',
                'psis_type_code' => '000004',
                'psis_value' => 'ADMINISTRACION',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000013',
                'psis_type_code' => '000004',
                'psis_value' => 'VENTAS',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000014',
                'psis_type_code' => '000004',
                'psis_value' => 'PRODUCCIÓN',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000015',
                'psis_type_code' => '000004',
                'psis_value' => 'CEO',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000016',
                'psis_type_code' => '000004',
                'psis_value' => 'MARKETING',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000017',
                'psis_type_code' => '000005',
                'psis_value' => 'PUNTUAL',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000018',
                'psis_type_code' => '000005',
                'psis_value' => 'TARDANZA',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000019',
                'psis_type_code' => '000005',
                'psis_value' => 'FALTA',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000020',
                'psis_type_code' => '000004',
                'psis_value' => 'DESARROLLO IOT',
                'psis_order' => 4,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000021',
                'psis_type_code' => '000004',
                'psis_value' => 'DESARROLLO HARDWARE',
                'psis_order' => 3,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000022',
                'psis_type_code' => '000004',
                'psis_value' => 'DESARROLLO BACKEND',
                'psis_order' => 2,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'psis_code' => '000023',
                'psis_type_code' => '000004',
                'psis_value' => 'DESARROLLO FRONTEND',
                'psis_order' => 1,
                'psis_status' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
