<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use DB;

class UserBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_block')->insert([
            [
                // 'ub_id' => 1,
                'user_id' => 1,
                'block_id' => 4,
                'psis_ub_role' => '000009',
                'ub_notification_status' => 0,
                'ub_status' => 1
            ],
            [
                // 'ub_id' => 1,
                'user_id' => 2,
                'block_id' => 4,
                'psis_ub_role' => '000009',
                'ub_notification_status' => 0,
                'ub_status' => 1
            ]
        ]);
    }
}
