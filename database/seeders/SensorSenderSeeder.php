<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SensorSenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");

        DB::table('sensor_sender')->insert([
            [
                // 'ss_id' => 1,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'MDR2',
                'ss_status' => 1
            ],[
                // 'ss_id' => 2,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'MDR1',
                'ss_status' => 1
            ],[
                // 'ss_id' => 3,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'MDR0',
                'ss_status' => 1
            ],[
                // 'ss_id' => 4,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'MDR3',
                'ss_status' => 1
            ],[
                // 'ss_id' => 5,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'AI0',
                'ss_status' => 1
            ],[
                // 'ss_id' => 6,
                'sensor_id' => 1,
                'sender_id' => 1,
                'slot_id' => 1,
                'ss_channel' => 'AI1',
                'ss_status' => 1
            ],
        ]);
    }
}
