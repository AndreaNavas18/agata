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
        $roleProgramador = Role::find(9);
        Permission::create(['name' => 'permissions.edit', 'submodule_id' => 7])->syncRoles([$roleProgramador]);
        
    }
}
