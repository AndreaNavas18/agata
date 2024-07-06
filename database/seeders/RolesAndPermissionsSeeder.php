<?php

namespace Database\Seeders;

use App\Models\Roles\Role;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Roles
        Role::firstOrCreate(['name' => 'admin']);

        // Asignación de roles
        $usuario = User::where('email', 'jcalderon@stratecsa.com')->first();
        if ($usuario && !$usuario->hasRole('admin')) {
            $usuario->assignRole('admin');
        }
     }
}
