<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d h:i:s");
        Parameter::truncate();

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 1,
                'parameter_codename' => "PH",
                'parameter_name' => "pH",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 2,
                'parameter_codename' => "DO",
                'parameter_name' => "Disolución de Oxígeno",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 3,
                'parameter_codename' => "CE",
                'parameter_name' => "Conductividad Eléctrica",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 4,
                'parameter_codename' => "TMP",
                'parameter_name' => "Temperatura",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 5,
                'parameter_codename' => "ORP",
                'parameter_name' => "Potencial Oxido-Reducción",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 6,
                'parameter_codename' => "TRB",
                'parameter_name' => "Turbiedad",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 7,
                'parameter_codename' => "CR",
                'parameter_name' => "Cloro Residual",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 8,
                'parameter_codename' => "BT",
                'parameter_name' => "Bateria",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 9,
                'parameter_codename' => "Q",
                'parameter_name' => "Caudal",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 10,
                'parameter_codename' => "CER",
                'parameter_name' => "Resistencia Electrica Conductividad",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 11,
                'parameter_codename' => "LVL",
                'parameter_name' => "Nivel",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 12,
                'parameter_codename' => "VOL",
                'parameter_name' => "Volumen",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 13,
                'parameter_codename' => "A2",
                'parameter_name' => "Area",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 14,
                'parameter_codename' => "CA",
                'parameter_name' => "Corriente Alterna",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 15,
                'parameter_codename' => "CD",
                'parameter_name' => "Corriente Directa",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('parameter')->insert(
            [
                // 'parameter_id' => 16,
                'parameter_codename' => "VEL",
                'parameter_name' => "Velocidad Agua",
                'parameter_description' => "",
                'parameter_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );


    }
}
