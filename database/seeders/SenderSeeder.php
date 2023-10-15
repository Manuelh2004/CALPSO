<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");

        DB::table('sender')->insert([
            [
                // 'sender_id' => 1,
                'st_id' => 1,
                'sender_serial' => 'jot00018',
                'sender_status' => 1,
                'sender_last_heart_beat' => $now
            ]
        ]);
    }
}
