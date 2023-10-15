<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");

        DB::table('sensor')->insert([
            [
                // 'sensor_id' => 1,
                'sm_id' => 1,
                'sensor_codename' => 'PH',
                'sensor_serial' => '22110767-PH',
                'sensor_status' => 1
            ],
            [
                // 'sensor_id' => 2,
                'sm_id' => 2,
                'sensor_codename' => 'TMP',
                'sensor_serial' => '22110767-TMP',
                'sensor_status' => 1
            ],
            [
                // 'sensor_id' => 3,
                'sm_id' => 3,
                'sensor_codename' => 'CR',
                'sensor_serial' => '22110129',
                'sensor_status' => 1
            ],
            [
                // 'sensor_id' => 4,
                'sm_id' => 4,
                'sensor_codename' => 'CA',
                'sensor_serial' => 'PZEM14-05',
                'sensor_status' => 1
            ],
            [
                // 'sensor_id' => 5,
                'sm_id' => 5,
                'sensor_codename' => 'CD',
                'sensor_serial' => 'KEHAO-005',
                'sensor_status' => 1
            ],
            [
                // 'sensor_id' => 6,
                'sm_id' => 6,
                'sensor_codename' => 'Flujo',
                'sensor_serial' => 'HUAIBEI-005',
                'sensor_status' => 1
            ]
        ]);
    }
}
