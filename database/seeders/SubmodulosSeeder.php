<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Submodules\Submodule;

class SubmodulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Submodule::create(['name' => 'Dashboard', 'initials' => 'dashboard']);
        // Submodule::create(['name' => 'Permisos', 'initials'=> 'permisos']);
        // Submodule::create(['name' => 'Roles', 'initials'=> 'roles']);
        // Submodule::create(['name' => 'Submodulos', 'initials'=> 'submodulos']);
        // Submodule::create(['name' => 'Usuarios', 'initials'=> 'usuarios']);
        // Submodule::create(['name' => 'Parametros Empleados', 'initials'=> 'parametros.empleados']);
        // Submodule::create(['name' => 'Parametros General', 'initials'=> 'parametros.general']);
        // Submodule::create(['name' => 'Clientes', 'initials'=> 'clientes']);
        // Submodule::create(['name' => 'Empleados', 'initials'=> 'empleados']);
        // Submodule::create(['name' => 'Proveedores', 'initials'=> 'proveedores']);
        // Submodule::create(['name' => 'Proyectos', 'initials'=> 'proyectos']);
        // Submodule::create(['name' => 'Servicios', 'initials'=> 'servicios']);
        
        //Nueva Fila Comercial//07/05/2024
        Submodule::create(['name' => 'Comercial', 'initials'=> 'Comercial']);

    }
}
