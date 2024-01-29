<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleSubmanager = Role::create(['name' => 'Subgerente']);
        $roleAnalist = Role::create(['name' => 'Analista']);
    
        Permission::create([
                'name' => 'authenticate.home',
                'description' => 'Ver Dashboard'
            ])->syncRoles([$roleAdmin, $roleSubmanager, $roleAnalist]);

        Permission::create([
                'name' => 'authenticate.partner.index',
                'description' => 'Ver Socios'
            ])->syncRoles([$roleAdmin, $roleSubmanager, $roleAnalist]);
        Permission::create([
                'name' => 'authenticate.partner.create',
                'description' => 'Agregar Socios'
            ])->syncRoles([$roleAdmin, $roleSubmanager, $roleAnalist]);
        Permission::create([
                'name' => 'authenticate.partner.store',
                'description' => 'Almacenar Socio'
            ])->syncRoles([$roleAdmin, $roleSubmanager, $roleAnalist]);
        Permission::create([
                'name' => 'authenticate.partner.edit',
                'description' => 'Editar Socio'
            ])->syncRoles([$roleAdmin, $roleSubmanager]);
        Permission::create([
                'name' => 'authenticate.partner.update',
                'description' => 'Actualizar Socio'
            ])->syncRoles([$roleAdmin, $roleSubmanager]);
        Permission::create([
                'name' => 'authenticate.partner.disable',
                'description' => 'Eliminar Socio'
            ])->syncRoles($roleAdmin);
    
        Permission::create([
                'name' => 'authenticate.user.index',
                'description' => 'Ver Usuarios'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.create',
                'description' => 'Agregar Usuario'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.store',
                'description' => 'Almacenar Usuario'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.edit',
                'description' => 'Editar Usuario'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.update',
                'description' => 'Actualizar Usuario'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.disable',
                'description' => 'Eliminar Usuario'
            ])->syncRoles($roleAdmin);
        Permission::create([
                'name' => 'authenticate.user.setpass',
                'description' => 'Setear contraseña Usuario'
            ])->syncRoles($roleAdmin);

    }
}
