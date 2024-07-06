<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProduccionPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Roles viejos creados en la base de datos
        $admin = Role::find(1);
        $cliente = Role::find(2);
        $adminCliente = Role::find(3);
        $roleSoporte = Role::find(5);
        $roleAdmin = Role::find(6);
        $roleCliente = Role::find(7);
        $roleSuperCliente = Role::find(8);
        $roleProgramador = Role::find(9);
        $roleDirectorSoporte = Role::find(10);
        $roleAdministrativo = Role::find(11);
        $roleComercial = Role::find(12);


        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de permissions-----------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'permissions.index', 'submodule_id' => 7])->syncRoles([$roleProgramador]);
        Permission::firstOrCreate(['name' => 'permissions.create', 'submodule_id' => 7])->syncRoles([$roleProgramador]);
        Permission::firstOrCreate(['name' => 'permissions.destroy', 'submodule_id' => 7])->syncRoles([$roleProgramador]);
        Permission::firstOrCreate(['name' => 'permissions.search', 'submodule_id' => 7])->syncRoles([$roleProgramador]);
        Permission::firstOrCreate(['name' => 'permissions.edit', 'submodule_id' => 7])->syncRoles([$roleProgramador]);


        //---------------------------------------------------------------------------------------------------------
        //-------------------------------------Permisos para la vista de roles-------------------------------------
        //---------------------------------------------------------------------------------------------------------

        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'roles.index', 'submodule_id' => 8])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'roles.create', 'submodule_id' => 8])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'roles.edit', 'submodule_id' => 8])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'roles.destroy', 'submodule_id' => 8])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'roles.search', 'submodule_id' => 8])->syncRoles([$roleAdmin, $admin, $roleProgramador]);

        //---------------------------------------------------------------------------------------------------------
        //------------------------------------Permisos para la vista de submodulos---------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'submodules.index', 'submodule_id' => 9])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'submodules.create', 'submodule_id' => 9])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'submodules.edit', 'submodule_id' => 9])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'submodules.destroy', 'submodule_id' => 9])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'submodules.search', 'submodule_id' => 9])->syncRoles([$roleAdmin, $admin, $roleProgramador]);

        //---------------------------------------------------------------------------------------------------------
        //------------------------------------Permisos para la vista de usuarios-----------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'users.index', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $adminCliente, $roleSuperCliente, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'users.create', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $adminCliente, $roleSuperCliente, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'users.edit', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'users.destroy', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $adminCliente, $roleSuperCliente, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'users.search', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $adminCliente, $roleSuperCliente, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'users.assignment_permissions', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'users.assignment_permissions_update', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'users.show', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        //Usuarios perfil
        Permission::firstOrCreate(['name' => 'users.my_profile', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'users.update_my_profile', 'submodule_id' => 10])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de parametros------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'parametros.empleados.index', 'submodule_id' => 12])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'parametros.general.index', 'submodule_id' => 13])->syncRoles([$roleAdmin, $admin, $roleProgramador]);

        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de clientes--------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'customers.index', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.create', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.edit', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.destroy', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.search', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.contacts.destroy', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes ver, datos
        Permission::firstOrCreate(['name' => 'customers.show', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes ver, usuarios
        Permission::firstOrCreate(['name' => 'customers.users.index', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes ver, servicios
        Permission::firstOrCreate(['name' => 'customers.services.index', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'customers.services.search', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        //Clientes ver, proyectos
        Permission::firstOrCreate(['name' => 'customers.projects.index', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'customers.projects.search', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        //Clientes ver, tickets
        Permission::firstOrCreate(['name' => 'customers.tickets.index', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'customers.tickets.search', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        //Clientes editar, usuarios
        Permission::firstOrCreate(['name' => 'customers.users.create', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.users.edit', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes editar, servicios
        Permission::firstOrCreate(['name' => 'customers.services.create', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.services.edit', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.services.destroy', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.services.show', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes editar, proyectos
        Permission::firstOrCreate(['name' => 'customers.proyectos.create', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.proyectos.edit', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.proyectos.destroy', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.proyectos.show', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.proyectos.asignarServicio', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //Clientes editar, tickets
        Permission::firstOrCreate(['name' => 'customers.tickets.create', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.tickets.edit', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.tickets.destroy', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.tickets.show', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'customers.tickets.manage', 'submodule_id' => 14])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //---------------------------------------------------------------------------------------------------------
        //------------------------------Permisos para la vista de empleados----------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'employees.index', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador, $roleDirectorSoporte, $roleSoporte]);
        Permission::firstOrCreate(['name' => 'employees.create', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'employees.edit', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador, $roleSoporte, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'employees.destroy', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'employees.search', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador, $roleDirectorSoporte, $roleSoporte]);
        Permission::firstOrCreate(['name' => 'employees.show', 'submodule_id' => 15])->syncRoles([$roleAdmin, $admin, $roleProgramador, $roleDirectorSoporte, $roleSoporte]);

         //---------------------------------------------------------------------------------------------------------
        //------------------------------Permisos para la vista de proveedores----------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'providers.index', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'providers.create', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'providers.edit', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleProgramador, $roleDirectorSoporte, $roleSoporte]);
        Permission::firstOrCreate(['name' => 'providers.destroy', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleProgramador]);
        Permission::firstOrCreate(['name' => 'providers.search', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'providers.show', 'submodule_id' => 16])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de proyectos-------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'proyectos.index', 'submodule_id' => 17])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'proyectos.show', 'submodule_id' => 17])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'proyectos.edit', 'submodule_id' => 17])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'proyectos.destroy', 'submodule_id' => 17])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);

        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de servicios-------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'services.index', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'services.create', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'services.edit', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'services.destroy', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'services.search', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'services.show', 'submodule_id' => 18])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        //---------------------------------------------------------------------------------------------------------
        //---------------------------------Permisos para la vista de tickets---------------------------------------
        //---------------------------------------------------------------------------------------------------------
        //Para el ingreso en la vista
        Permission::firstOrCreate(['name' => 'tickets.index', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'tickets.create', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'tickets.edit', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte]);
        Permission::firstOrCreate(['name' => 'tickets.destroy', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'tickets.search', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'tickets.show', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);
        Permission::firstOrCreate(['name' => 'tickets.manage', 'submodule_id' => 1])->syncRoles([$roleAdmin, $admin, $roleSoporte, $roleProgramador, $roleDirectorSoporte, $admin, $cliente, $roleCliente, $roleSuperCliente]);

        $administrativoPermisos = [
            'parametros.empleados.index', 'parametros.general.index', 'customers.index', 'customers.create',
            'customers.edit', 'customers.search', 'customers.contacts.destroy', 'customers.show', 'customers.users.index',
            'customers.services.index', 'customers.services.search', 'customers.projects.index', 'customers.projects.search',
            'customers.services.show', 'customers.proyectos.show', 'employees.index', 'employees.create', 'employees.edit',
            'employees.destroy', 'employees.search', 'employees.show', 'providers.index', 'providers.create', 'providers.edit',
            'providers.search', 'providers.show', 'proyectos.index', 'proyectos.show', 'services.index', 'services.search', 'services.show'
        ];

        foreach ($administrativoPermisos as $permisos) {
            if (!$roleAdministrativo->hasPermissionTo($permisos)) {
                $roleAdministrativo->givePermissionTo($permisos);
            }
        }

        Permission::firstOrCreate(['name' => 'commercial.index', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        Permission::firstOrCreate(['name' => 'commercial.create', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        Permission::firstOrCreate(['name' => 'commercial.edit', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        Permission::firstOrCreate(['name' => 'commercial.destroy', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        Permission::firstOrCreate(['name' => 'commercial.search', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        Permission::firstOrCreate(['name' => 'commercial.show', 'submodule_id' => 19])->syncRoles([$roleComercial]);
        
        $commercialPermisos = ['commercial.index', 'commercial.create', 'commercial.edit', 'commercial.destroy', 'commercial.search', 'commercial.show'];

        foreach ($commercialPermisos as $permisos) {
            if (!$roleComercial->hasPermissionTo($permisos)) {
                $roleComercial->givePermissionTo($permisos);
            }
            if (!$roleAdmin->hasPermissionTo($permisos)) {
                $roleAdmin->givePermissionTo($permisos);
            }
            if (!$admin->hasPermissionTo($permisos)) {
                $admin->givePermissionTo($permisos);
            }
            if (!$roleProgramador->hasPermissionTo($permisos)) {
                $roleProgramador->givePermissionTo($permisos);
            }
        }

       
    }
}


       