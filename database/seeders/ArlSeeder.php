<?php

namespace Database\Seeders;

use App\Models\Arl;
use Illuminate\Database\Seeder;

class ArlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Arl::create(['arl' => 'Sura']);
        Arl::create(['arl' => 'Positiva']);
        Arl::create(['arl' => 'Colmena']);
    }
}
