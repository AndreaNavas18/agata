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
        TypeContact::firstOrCreate(['name' => 'Comercial']);
        TypeContact::firstOrCreate(['name' => 'Financiero']);
        TypeContact::firstOrCreate(['name' => 'Soporte']);

        // Tipos de Documentos
        TypeDocument::firstOrCreate(['name' => 'Cédula']);
        TypeDocument::firstOrCreate(['name' => 'Cédula de Extranjería']);
        TypeDocument::firstOrCreate(['name' => 'Pasaporte']);
        TypeDocument::firstOrCreate(['name' => 'Tarjeta de Identidad']);
        TypeDocument::firstOrCreate(['name' => 'Registro Civil']);

        //servicios
        Service::firstOrCreate(['name' => 'Internet']);
        Service::firstOrCreate(['name' => 'Hosting']);
        Service::firstOrCreate(['name' => 'Servidor']);
        Service::firstOrCreate(['name' => 'Desarrollo']);

    }

}
