<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");

        DB::table('slot')->insert(
            [
                // 'slot_id' => 1,
                'parameter_id' => 1,
                'block_id' => 4,
                'sensor_id' => 1,
                'up_danger_limit' => 14,
                'up_risk_limit' => 14,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'slot_id' => 2,
                'parameter_id' => 2,
                'block_id' => 4,
                'sensor_id' => 2,
                'up_danger_limit' => 60,
                'up_risk_limit' => 60,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'slot_id' => 3,
                'parameter_id' => 3,
                'block_id' => 4,
                'sensor_id' => 3,
                'up_danger_limit' => 20,
                'up_risk_limit' => 20,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'slot_id' => 4,
                'parameter_id' => 4,
                'block_id' => 4,
                'sensor_id' => 4,
                'up_danger_limit' => 10,
                'up_risk_limit' => 10,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'slot_id' => 5,
                'parameter_id' => 5,
                'block_id' => 4,
                'sensor_id' => 5,
                'up_danger_limit' => 5000,
                'up_risk_limit' => 5000,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],[
                // 'slot_id' => 6,
                'parameter_id' => 6,
                'block_id' => 4,
                'sensor_id' => 6,
                'up_danger_limit' => 645,
                'up_risk_limit' => 645,
                'down_risk_limit' => 0,
                'down_danger_limit' => 0,
                'slot_average_limit_state' => 0,
                'slot_status' => 1,
                'slot_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );
    }
}
