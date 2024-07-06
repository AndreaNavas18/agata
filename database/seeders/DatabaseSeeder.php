<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GeneralTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(SubmodulosSeeder::class);
        
        $this->call(RoleSeeder::class);
        $this->call(ProduccionPermisos::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
