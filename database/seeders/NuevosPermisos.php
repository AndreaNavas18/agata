<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NuevosPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roleProgramador = Role::find(9);
        // Permission::create(['name' => 'permissions.edit', 'submodule_id' => 7])->syncRoles([$roleProgramador]);

        // $rolesIds = [1,2,3,5,6,7,8,9];
        // $roles = Role::whereIn('id', $rolesIds)->get();

        // if ($roles->isNotEmpty()) {
        //     foreach ($roles as $role) {
            //Permisos dados el dia 8 de marzo del 2024 por seeder
        //         $role->givePermissionTo(['tickets.index', 'tickets.show', 'tickets.create', 'tickets.edit', 'tickets.destroy', 'tickets.search', 'tickets.manage']);
        //     }
        // }

        // if ($roles->isNotEmpty()) {
        //     foreach ($roles as $role) {
        //     //Permisos dados el dia 8 de marzo del 2024 por seeder
        //         $role->givePermissionTo(['users.my_profile', 'users.update_my_profile', 'customers.services.index', 
        //         'customers.services.search', 'customers.projects.index', 'customers.projects.search', 'customers.tickets.index',
        //         'customers.tickets.search', 'proyectos.index', 'proyectos.show', 'services.index', 'services.show', 'services.search'
        //     ]);
        //     }
        // }

        // $roleSoporte = Role::find(5);

        //     //Permisos dados el dia 11 de marzo del 2024 por seeder
        //         $roleSoporte->givePermissionTo(['employees.index', 'employees.edit', 'employees.show', 'employees.search', 
        //         'providers.index', 'providers.edit', 'providers.show', 'providers.search']);
        
        $roleDirectorSoporte = Role::find(10);

        //Permisos dados el dia 23 de marzo del 2024 por seeder, pero el rol se creo en la vista
            $roleDirectorSoporte->givePermissionTo(['users.my_profile', 'users.update_my_profile', 'customers.index', 
            'customers.destroy', 'customers.search', 'customers.create', 'customers.edit', 'customers.contacts.destroy',
            'customers.show', 'customers.users.index', 'customers.services.index', 'customers.services.search', 'customers.projects.index',
            'customers.projects.search', 'customers.tickets.index', 'customers.tickets.search', 'customers.users.create',
            'customers.users.edit', 'customers.services.create', 'customers.services.edit', 'customers.services.destroy',
            'customers.services.show', 'customers.proyectos.create', 'customers.proyectos.edit', 'customers.proyectos.destroy',
            'customers.proyectos.show', 'customers.proyectos.asignarServicio', 'customers.tickets.create', 'customers.tickets.edit',
            'customers.tickets.destroy', 'customers.tickets.show', 'customers.tickets.manage', 'providers.index', 'providers.search', 
            'providers.show', 'proyectos.index', 'proyectos.show', 'proyectos.edit', 'proyectos.destroy', 'services.index',
            'services.create','services.edit','services.destroy','services.search','services.show','tickets.index','tickets.create',
            'tickets.edit','tickets.destroy','tickets.search','tickets.show','tickets.manage']);

            
    }
}
