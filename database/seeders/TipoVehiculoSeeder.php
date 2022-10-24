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
        TipoVehiculo::create(['tipo' => 'Automóvil']);
        TipoVehiculo::create(['tipo' => 'Bicicleta']);
        TipoVehiculo::create(['tipo' => 'Camión de carga']); 
        TipoVehiculo::create(['tipo' => 'Camioneta']);
        TipoVehiculo::create(['tipo' => 'Moto']);
        TipoVehiculo::create(['tipo' => 'Scooter eléctrico']);
        TipoVehiculo::create(['tipo' => 'Volqueta']);
        TipoVehiculo::create(['tipo' => 'Otro']);
    }
}
