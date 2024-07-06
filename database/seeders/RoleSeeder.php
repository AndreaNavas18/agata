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
     *
     * @return void
     */
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::firstOrCreate(['name' => 'Cliente']);
        Role::firstOrCreate(['name' => 'Admincliente']);
        Role::firstOrCreate(['name' => 'borrarlo']);
        Role::firstOrCreate(['name' => 'Soporte']);
        Role::firstOrCreate(['name' => 'Administrador']);
        Role::firstOrCreate(['name' => 'Usuario_cliente']);
        Role::firstOrCreate(['name' => 'Usuario_super_cliente']);
        Role::firstOrCreate(['name' => 'Programador']);
        Role::firstOrCreate(['name' => 'Director_soporte']);
        Role::firstOrCreate(['name' => 'Administrativo']);
        Role::firstOrCreate(['name' => 'Comercial']);

    }
}
