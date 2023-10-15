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
        $this->call(SenderTypeSeeder::class);
        $this->call(MeasurementUnitSeeder::class);
        $this->call(ParameterSeeder::class);
        $this->call(SensorModelSeeder::class);
        
        
        $this->call(BlocksSeeder::class);
        $this->call(WF13ES22_Seeder::class);
        $this->call(WF14ES22_Seeder::class);
        
        /*
        $this->call(SenderSeeder::class);
        $this->call(UserBlocksSeeder::class);
        $this->call(SensorSeeder::class);
        $this->call(SlotsSeeder::class);
        $this->call(SensorSenderSeeder::class);
        $this->call(SenderBlocksSeeder::class);
        */
    }
}
