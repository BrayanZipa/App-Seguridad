<?php

namespace Database\Seeders;

use App\Models\Eps;
use Illuminate\Database\Seeder;

class EpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eps::create(['eps' => 'Aliansalud']);
        Eps::create(['eps' => 'Anas Wayuu EPSI']);
        Eps::create(['eps' => 'Asociación Indígina del Cauca - AICEPSI']);
        Eps::create(['eps' => 'Cajacopi']);
        Eps::create(['eps' => 'Capital salud']);
        Eps::create(['eps' => 'Capresoca']);
        Eps::create(['eps' => 'Comfachoco']);
        Eps::create(['eps' => 'Comfamiliar de la Guajira']);
        Eps::create(['eps' => 'Comfaoriente']);
        Eps::create(['eps' => 'Comfenalco valle']);
        Eps::create(['eps' => 'Compensar']);
        Eps::create(['eps' => 'Coosalud']);
        Eps::create(['eps' => 'Dusakawi Epsi']);
        Eps::create(['eps' => 'Ecoopsos']);
        Eps::create(['eps' => 'Empresas Públicas de Medellín - EPM']);
        Eps::create(['eps' => 'Emssanar']);
        Eps::create(['eps' => 'EPS Familiar de Colombia']);
        Eps::create(['eps' => 'EPS Sura']);
        Eps::create(['eps' => 'Famisanar']);
        Eps::create(['eps' => 'Fondo de Pasivo Social de Ferrocarriles Nacionales de Colombia']);
        Eps::create(['eps' => 'Mallamas EPSI']);
        Eps::create(['eps' => 'Mutualser']);
        Eps::create(['eps' => 'Nueva EPS']);
        Eps::create(['eps' => 'Pijaos salud EPSI']);
        Eps::create(['eps' => 'Salud mía']);
        Eps::create(['eps' => 'Salud total']);
        Eps::create(['eps' => 'Sanitas']);
        Eps::create(['eps' => 'Savia salud']);
        Eps::create(['eps' => 'Servicio occidental de salud - SOS']);
        Eps::create(['eps' => 'Otra']);
    }
}
