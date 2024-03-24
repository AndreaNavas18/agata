<?php

namespace App\Imports;

use App\Models\Providers\ProviderContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Providers\Provider;
use App\Models\General\TypeDocument;
use App\Models\General\City;
use App\Models\Providers\ProviderState;
use App\Models\General\TypeContact;

class ProviderContactImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //Busca el Id del proveedor
        $provider = Provider::where('name', 'like', '%' .$row['nombre_proveedor']. '%')->first();

        //Busca el ID del tipo de contacto
        $typeContact = TypeContact::where('name', 'like', '%' . $row['tipo_de_contacto'] . '%')->first();

        // Busca el ID de la ciudad
        $city = City::where('name', '=', $row['nombre_ciudad'])->first();

        return new ProviderContact([
            'provider_id' => $provider->id,
            'type_contact_id' => $typeContact->id,
            'city_id' => $city->id,
            'name' => $row['nombre'],
            'home_phone' => $row['telefono_casa'],
            'cell_phone' => $row['telefono'],
            'email' => $row['correo_electronico'],
        ]);
            
        
    }
}
