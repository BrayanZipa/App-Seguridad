<?php

namespace Database\Seeders;

use App\Models\MarcaVehiculo;
use Illuminate\Database\Seeder;

class MarcaVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcaVehiculo::create(['marca' => 'Chevrolet']);
        MarcaVehiculo::create(['marca' => 'Renault']);
        MarcaVehiculo::create(['marca' => 'Ford']); 
        MarcaVehiculo::create(['marca' => 'Audi']);
        MarcaVehiculo::create(['marca' => 'Mazda']);
        MarcaVehiculo::create(['marca' => 'Honda']); 
        MarcaVehiculo::create(['marca' => 'Hino']); 
    }
}
