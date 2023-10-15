<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SenderBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sender_block')->insert([
            [
                // 'sb_id' => 1,
                'block_id' => 4,
                'sender_id' => 1,
                'sb_status' => 1,
            ]
        ]);
    }
}
