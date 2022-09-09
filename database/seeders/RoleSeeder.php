<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Seguridad']);
        $role3 = Role::create(['name' => 'Porteria']);
        Role::create(['name' => 'Consulta']);

        Permission::create(['name' => 'mostrarUsuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'editarUsuario'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'formCrearVisitante'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crearVisitante'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editarVisitante'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'formCrearColaborador'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crearColaborador'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editarColaborador'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'formCrearConductor'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crearConductor'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editarConductor'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'formCrearVehiculo'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'crearVehiculo'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'editarVehiculo'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'formCrearRegistro'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'registrarIngreso'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'registrarSalida'])->syncRoles([$role1, $role2, $role3]);
    }
}