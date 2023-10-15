<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MeasurementUnit;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        MeasurementUnit::truncate();

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 1,
                'mu_code' => "mg/L",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 2,
                'mu_code' => "ppm",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 3,
                'mu_code' => "oC",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 4,
                'mu_code' => "mV",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 5,
                'mu_code' => "uS/cm",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 6,
                'mu_code' => "pH",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 7,
                'mu_code' => "NTU",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 8,
                'mu_code' => "V",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 9,
                'mu_code' => "m3/H",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 10,
                'mu_code' => "ohm",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 11,
                'mu_code' => "%",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 12,
                'mu_code' => "m",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 13,
                'mu_code' => "Psi",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 14,
                'mu_code' => "m2",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 15,
                'mu_code' => "m3",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 16,
                'mu_code' => "A",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 17,
                'mu_code' => "mA",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 18,
                'mu_code' => "L/H",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('measurement_unit')->insert(
            [
                // 'mu_id' => 19,
                'mu_code' => "m/s",
                'mu_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}
