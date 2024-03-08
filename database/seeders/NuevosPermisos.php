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

        $rolesIds = [1,2,3,5,6,7,8,9];
        $roles = Role::whereIn('id', $rolesIds)->get();

        // if ($roles->isNotEmpty()) {
        //     foreach ($roles as $role) {
            //Permisos dados el dia 8 de marzo del 2024 por seeder
        //         $role->givePermissionTo(['tickets.index', 'tickets.show', 'tickets.create', 'tickets.edit', 'tickets.destroy', 'tickets.search', 'tickets.manage']);
        //     }
        // }

        if ($roles->isNotEmpty()) {
            foreach ($roles as $role) {
            //Permisos dados el dia 8 de marzo del 2024 por seeder
                $role->givePermissionTo(['users.my_profile', 'users.update_my_profile', 'customers.services.index', 
                'customers.services.search', 'customers.projects.index', 'customers.projects.search', 'customers.tickets.index',
                'customers.tickets.search', 'proyectos.index', 'proyectos.show', 'services.index', 'services.show', 'services.search'
            ]);
            }
        }
    }
}
