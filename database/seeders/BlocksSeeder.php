<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;


class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");

        //BLOQUES

        DB::table('block')->insert([
            [
                // 'block_id' => 1,
                'psis_block_type' => '000016',
                'block_codename' => 'DEMO',
                'block_name' => 'PRUEBAS DTU',
                'parent_block_id' => null,
                'created_at' => $now
            ],[
                // 'block_id' => 2,
                'psis_block_type' => '000016',
                'block_codename' => 'WP2108',
                'block_name' => 'SUNASS 2021',
                'parent_block_id' => null,
                'created_at' => $now
            ],[
                // 'block_id' => 3,
                'psis_block_type' => '000016',
                'block_codename' => 'WP2208B',
                'block_name' => 'SUNASS 2022',
                'parent_block_id' => null,
                'created_at' => $now
            ],[
                // 'block_id' => 4,
                'psis_block_type' => '000016',
                'block_codename' => 'WP2208A',
                'block_name' => 'BID 2022',
                'parent_block_id' => null,
                'created_at' => $now
            ]
        ]);
    }
}
