<?php

namespace Database\Seeders;

use App\Models\TipoVehiculo;
use Illuminate\Database\Seeder;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoVehiculo::create(['tipo' => 'Carro']);
        TipoVehiculo::create(['tipo' => 'Moto']);
        TipoVehiculo::create(['tipo' => 'Bicicleta']); 
        TipoVehiculo::create(['tipo' => 'Camión']);
    }
}
