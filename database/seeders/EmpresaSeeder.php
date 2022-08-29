<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create(['nombre' => 'Aviomar']);
        Empresa::create(['nombre' => 'Snider']);
        Empresa::create(['nombre' => 'Colvan']);
    }
}
