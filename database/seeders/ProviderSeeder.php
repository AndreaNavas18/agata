<?php

namespace Database\Seeders;

use App\Models\Providers\ProviderState;
use Illuminate\Database\Seeder;

class ProviderSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        // estados
        ProviderState::firstOrCreate(['name' => 'Activo']);
        ProviderState::firstOrCreate(['name' => 'Inactivo']);
    }

}
