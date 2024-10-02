<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevTipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cliente')->insert([
            [
                'nombre_tipo' => 'Regular',
                'descripcion' => 'Cliente habitual',
                'descuento_asociado' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
