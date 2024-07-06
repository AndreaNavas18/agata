<?php

namespace Database\Seeders;

use App\Models\Customers\CustomerState;
use Illuminate\Database\Seeder;

class CustomerSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        // estados
        CustomerState::firstOrCreate(['name' => 'Activo']);
        CustomerState::firstOrCreate(['name' => 'Inactivo']);
        CustomerState::firstOrCreate(['name' => 'Suspendido']);
    }

}
