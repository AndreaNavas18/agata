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

        // Role::create(['name' => 'soporte']);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de permissions-----------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'permissions.index', 'submodule_id' => 7]);
        // Permission::create(['name' => 'permissions.create', 'submodule_id' => 7]);
        // Permission::create(['name' => 'permissions.destroy', 'submodule_id' => 7]);
        // Permission::create(['name' => 'permissions.search', 'submodule_id' => 7]);

        // //---------------------------------------------------------------------------------------------------------
        // //-------------------------------------Permisos para la vista de roles-------------------------------------
        // //---------------------------------------------------------------------------------------------------------

        // //Para el ingreso en la vista
        // Permission::create(['name' => 'roles.index', 'submodule_id' => 8]);
        // Permission::create(['name' => 'roles.create', 'submodule_id' => 8]);
        // Permission::create(['name' => 'roles.edit', 'submodule_id' => 8]);
        // Permission::create(['name' => 'roles.destroy', 'submodule_id' => 8]);
        // Permission::create(['name' => 'roles.search', 'submodule_id' => 8]);

        // //---------------------------------------------------------------------------------------------------------
        // //------------------------------------Permisos para la vista de submodulos---------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'submodules.index', 'submodule_id' => 9]);
        // Permission::create(['name' => 'submodules.create', 'submodule_id' => 9]);
        // Permission::create(['name' => 'submodules.edit', 'submodule_id' => 9]);
        // Permission::create(['name' => 'submodules.destroy', 'submodule_id' => 9]);
        // Permission::create(['name' => 'submodules.search', 'submodule_id' => 9]);

        // //---------------------------------------------------------------------------------------------------------
        // //------------------------------------Permisos para la vista de usuarios-----------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'users.index', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.create', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.edit', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.destroy', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.search', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.ssignment_permissions', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.assignment_permissions_update', 'submodule_id' => 10]);
        // //Usuarios perfil
        // Permission::create(['name' => 'users.my_profile', 'submodule_id' => 10]);
        // Permission::create(['name' => 'users.update_my_profile', 'submodule_id' => 10]);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de parametros------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'parametros.empleados.index', 'submodule_id' => 12]);
        // Permission::create(['name' => 'parametros.general.index', 'submodule_id' => 13]);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de clientes--------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'customers.index', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.create', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.edit', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.destroy', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.search', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.contacts.destroy', 'submodule_id' => 14]);

        // //Clientes ver, datos
        // Permission::create(['name' => 'customers.show', 'submodule_id' => 14]);

        // //Clientes ver, usuarios
        // Permission::create(['name' => 'customers.users.index', 'submodule_id' => 14]);

        // //Clientes ver, servicios
        // Permission::create(['name' => 'customers.services.index', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.services.search', 'submodule_id' => 14]);

        // //Clientes ver, proyectos
        // Permission::create(['name' => 'customers.projects.index', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.projects.search', 'submodule_id' => 14]);

        // //Clientes ver, tickets
        // Permission::create(['name' => 'customers.tickets.index', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.tickets.search', 'submodule_id' => 14]);

        // //Clientes editar, usuarios
        // Permission::create(['name' => 'customers.users.create', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.users.edit', 'submodule_id' => 14]);

        // //Clientes editar, servicios
        // Permission::create(['name' => 'customers.services.create', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.services.edit', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.services.destroy', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.services.show', 'submodule_id' => 14]);

        // //Clientes editar, proyectos
        // Permission::create(['name' => 'customers.proyectos.create', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.proyectos.edit', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.proyectos.destroy', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.proyectos.show', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.proyectos.asignarServicio', 'submodule_id' => 14]);

        // //Clientes editar, tickets
        // Permission::create(['name' => 'customers.tickets.create', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.tickets.edit', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.tickets.destroy', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.tickets.show', 'submodule_id' => 14]);
        // Permission::create(['name' => 'customers.tickets.manage', 'submodule_id' => 14]);

        // //---------------------------------------------------------------------------------------------------------
        // //------------------------------Permisos para la vista de empleados----------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'employees.index', 'submodule_id' => 15]);
        // Permission::create(['name' => 'employees.create', 'submodule_id' => 15]);
        // Permission::create(['name' => 'employees.edit', 'submodule_id' => 15]);
        // Permission::create(['name' => 'employees.destroy', 'submodule_id' => 15]);
        // Permission::create(['name' => 'employees.search', 'submodule_id' => 15]);
        // Permission::create(['name' => 'employees.show', 'submodule_id' => 15]);

        //  //---------------------------------------------------------------------------------------------------------
        // //------------------------------Permisos para la vista de proveedores----------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'providers.index', 'submodule_id' => 16]);
        // Permission::create(['name' => 'providers.create', 'submodule_id' => 16]);
        // Permission::create(['name' => 'providers.edit', 'submodule_id' => 16]);
        // Permission::create(['name' => 'providers.destroy', 'submodule_id' => 16]);
        // Permission::create(['name' => 'providers.search', 'submodule_id' => 16]);
        // Permission::create(['name' => 'providers.show', 'submodule_id' => 16]);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de proyectos-------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'proyectos.index', 'submodule_id' => 17]);
        // Permission::create(['name' => 'proyectos.show', 'submodule_id' => 17]);
        // Permission::create(['name' => 'proyectos.edit', 'submodule_id' => 17]);
        // Permission::create(['name' => 'proyectos.destroy', 'submodule_id' => 17]);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de servicios-------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'services.index', 'submodule_id' => 18]);
        // Permission::create(['name' => 'services.create', 'submodule_id' => 18]);
        // Permission::create(['name' => 'services.edit', 'submodule_id' => 18]);
        // Permission::create(['name' => 'services.destroy', 'submodule_id' => 18]);
        // Permission::create(['name' => 'services.search', 'submodule_id' => 18]);
        // Permission::create(['name' => 'services.show', 'submodule_id' => 18]);

        // //---------------------------------------------------------------------------------------------------------
        // //---------------------------------Permisos para la vista de tickets---------------------------------------
        // //---------------------------------------------------------------------------------------------------------
        // //Para el ingreso en la vista
        // Permission::create(['name' => 'tickets.index', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.create', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.edit', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.destroy', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.search', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.show', 'submodule_id' => 1]);
        // Permission::create(['name' => 'tickets.manage', 'submodule_id' => 1]);

    }
}
