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
        Eps::create(['eps' => 'Famisanar']);
        Eps::create(['eps' => 'Compensar']);
        Eps::create(['eps' => 'Salud total']);
    }
}
