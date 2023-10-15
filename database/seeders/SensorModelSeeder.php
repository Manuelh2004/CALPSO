<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SensorModel;

class SensorModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        SensorModel::truncate();

        DB::table('sensor_model')->insert([
            [
                // 'sm_id' => 1,
                'sm_name' => 'Sensor PH BOQU',
                'sm_codename' => 'PH Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'BH-485-EC-301',
                'parameter_id' => 1,
                'mu_id' => 6,
                'sm_max_limit' => 14,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 2,
                'sm_name' => 'Sensor Temperatura BOQU',
                'sm_codename' => 'TMP Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'BH-485-EC-301',
                'parameter_id' => 4,
                'mu_id' => 3,
                'sm_max_limit' => 60,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 3,
                'sm_name' => 'Sensor Cloro Residual BOQU',
                'sm_codename' => 'CR Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'CL-2059-01',
                'parameter_id' => 7,
                'mu_id' => 1,
                'sm_max_limit' => 20,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 4,
                'sm_name' => 'Transmisor Corriente Alterna',
                'sm_codename' => 'CA',
                'sm_brand' => 'Peace Fair',
                'sm_model' => 'PZEM-014',
                'parameter_id' => 14,
                'mu_id' => 16,
                'sm_max_limit' => 10,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 5,
                'sm_name' => 'Transmisor Corriente Continua',
                'sm_codename' => 'CD',
                'sm_brand' => 'KEHAO',
                'sm_model' => 'KTA8-B-5A',
                'parameter_id' => 15,
                'mu_id' => 17,
                'sm_max_limit' => 5000,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 6,
                'sm_name' => 'Transmisor Frecuencia',
                'sm_codename' => 'Caudal',
                'sm_brand' => 'HUAIBEI',
                'sm_model' => 'HDF-B1N-1000',
                'parameter_id' => 9,
                'mu_id' => 18,
                'sm_max_limit' => 645,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 7,
                'sm_name' => 'Sensor PH BOQU',
                'sm_codename' => 'PH Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'PH-BID',
                'parameter_id' => 1,
                'mu_id' => 6,
                'sm_max_limit' => 14,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 8,
                'sm_name' => 'Sensor Temperatura BOQU',
                'sm_codename' => 'TMP Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'PH-BID',
                'parameter_id' => 4,
                'mu_id' => 3,
                'sm_max_limit' => 60,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 9,
                'sm_name' => 'Sensor Cloro Residual BOQU',
                'sm_codename' => 'CR Sensor',
                'sm_brand' => 'BOQU',
                'sm_model' => 'CL-2059-BID',
                'parameter_id' => 7,
                'mu_id' => 1,
                'sm_max_limit' => 2,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 10,
                'sm_name' => 'Sensor Turbidez BOQU',
                'sm_codename' => 'TRB',
                'sm_brand' => 'BOQU',
                'sm_model' => 'TRB-BID',
                'parameter_id' => 6,
                'mu_id' => 7,
                'sm_max_limit' => 100,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 11,
                'sm_name' => 'Medidor de caudal BOQU',
                'sm_codename' => 'Caudal',
                'sm_brand' => 'BOQU',
                'sm_model' => 'CAUDAL-BID',
                'parameter_id' => 9,
                'mu_id' => 9,
                'sm_max_limit' => 1000,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ],
            [
                // 'sm_id' => 12,
                'sm_name' => 'Medidor de Velocidad BOQU',
                'sm_codename' => 'Velocidad',
                'sm_brand' => 'BOQU',
                'sm_model' => 'CAUDAL-BID',
                'parameter_id' => 16,
                'mu_id' => 19,
                'sm_max_limit' => 100,
                'sm_min_limit' => 0,
                'sm_status' => 1,
            ]
        ]);
    }
}
