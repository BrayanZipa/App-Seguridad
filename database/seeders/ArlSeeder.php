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
        Arl::create(['arl' => 'Aurora seguros de vida']);
        Arl::create(['arl' => 'Axa Colpatria seguros']);
        Arl::create(['arl' => 'Colmena seguros']);
        Arl::create(['arl' => 'Equidad seguros']);
        Arl::create(['arl' => 'Liberty seguros']);
        Arl::create(['arl' => 'Mapfre seguros']);
        Arl::create(['arl' => 'Positiva']);
        Arl::create(['arl' => 'Seguros Alfa']);
        Arl::create(['arl' => 'Seguros Bolívar']);
        Arl::create(['arl' => 'Sura']);
        Arl::create(['arl' => 'Otra']);
    }
}
