<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo_usuario')->insert([
            [
                'nombre_cargo' => 'Cocinero',
                'descripcion' => 'Ninguna',
                'salario_base' => 150
            ]
        ]);
    }
}
