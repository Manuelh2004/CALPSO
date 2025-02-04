<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PSISSeeder::class);
        $this->call(PSIS_TIPOSeeder::class);
        $this->call(UsuariosIniciales::class);
        $this->call(DevTipoClienteSeeder::class);
        $this->call(AreaUsuarioSeeder::class);
        $this->call(CargoUsuarioSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        //$this->call(DevClienteSeeder::class);
    }
}
