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
        // \App\Models\User::factory(10)->create();
        $this->call(EmpresaSeeder::class);
        $this->call(TipoPersonaSeeder::class);
        $this->call(EpsSeeder::class);
        $this->call(ArlSeeder::class);
        $this->call(TipoVehiculoSeeder::class);
        // $this->call(MarcaVehiculoSeeder::class);
        $this->call(RoleSeeder::class);
    }
}