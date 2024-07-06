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
        Submodule::firstOrCreate(['name' => 'Tickets', 'initials'=> 'tickets']);
        Submodule::firstOrCreate(['name' => 'borarrlo', 'initials'=> 'borrarlo']);
        Submodule::firstOrCreate(['name' => 'borarrlo2', 'initials'=> 'borrarlo3']);
        Submodule::firstOrCreate(['name' => 'borarrlo3', 'initials'=> 'borrarlo3']);
        Submodule::firstOrCreate(['name' => 'Vista', 'initials'=> 'vista']);
        Submodule::firstOrCreate(['name' => 'Dashboard', 'initials' => 'dashboard']);
        Submodule::firstOrCreate(['name' => 'Permisos', 'initials'=> 'permisos']);
        Submodule::firstOrCreate(['name' => 'Roles', 'initials'=> 'roles']);
        Submodule::firstOrCreate(['name' => 'Submodulos', 'initials'=> 'submodulos']);
        Submodule::firstOrCreate(['name' => 'Usuarios', 'initials'=> 'usuarios']);
        Submodule::firstOrCreate(['name' => 'borarrlo4', 'initials'=> 'borrarlo4']);
        Submodule::firstOrCreate(['name' => 'Parametros Empleados', 'initials'=> 'parametros.empleados']);
        Submodule::firstOrCreate(['name' => 'Parametros General', 'initials'=> 'parametros.general']);
        Submodule::firstOrCreate(['name' => 'Clientes', 'initials'=> 'clientes']);
        Submodule::firstOrCreate(['name' => 'Empleados', 'initials'=> 'empleados']);
        Submodule::firstOrCreate(['name' => 'Proveedores', 'initials'=> 'proveedores']);
        Submodule::firstOrCreate(['name' => 'Proyectos', 'initials'=> 'proyectos']);
        Submodule::firstOrCreate(['name' => 'Servicios', 'initials'=> 'servicios']);
        Submodule::firstOrCreate(['name' => 'Comercial', 'initials'=> 'comercial']);


    }
}
