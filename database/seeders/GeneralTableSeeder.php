<?php

namespace Database\Seeders;

use App\Models\General\Service;
use App\Models\General\TypeContact;
use App\Models\General\TypeDocument;
use Illuminate\Database\Seeder;

class GeneralTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tipos de contactos
        // TypeContact::create(['name' => 'Comercial']);
        // TypeContact::create(['name' => 'Financiero']);
        // TypeContact::create(['name' => 'Soporte']);

        // Tipos de Documentos
        // TypeDocument::create(['name' => 'Cédula']);
        // TypeDocument::create(['name' => 'Cédula de Extranjería']);
        // TypeDocument::create(['name' => 'Pasaporte']);
        // TypeDocument::create(['name' => 'Tarjeta de Identidad']);
        // TypeDocument::create(['name' => 'Registro Civil']);

        //servicios
        // Service::create(['name' => 'Internet']);
        // Service::create(['name' => 'Hosting']);
        // Service::create(['name' => 'Servidor']);
        // Service::create(['name' => 'Desarrollo']);

    }

}
