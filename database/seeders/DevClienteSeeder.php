<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([
            [
                'id_tipo_cliente' => 1, // Regular
                'nombre_cliente' => 'Juan Perez',
                'genero' => 'M',
                'edad' => 30,
                'telefono' => '987654321',
                'estado' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
