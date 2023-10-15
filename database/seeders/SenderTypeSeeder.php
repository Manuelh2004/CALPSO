<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SenderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sender_type')->insert([
            [
                // 'st_id' => 1,
                'st_model' => 'CWT-L0021S',
                'st_brand' => 'CWT',
                'st_status' => 1
            ]
        ]);
    }
}
