<?php

namespace App\Imports;

use App\Models\Providers\Provider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\General\TypeDocument;
use App\Models\General\City;
use App\Models\Providers\ProviderState;
use App\Models\Providers\ProviderContact;

class ProviderImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //  Busca el ID del tipo de documento
        $typeDocument = TypeDocument::where('name', 'like', '%' . $row['tipo_documento'] . '%')->first();

        // Busca el ID de la ciudad
        $city = City::where('name', '=', $row['nombre_ciudad'])->first();

        // Busca el ID de el estado del proveedor
        $providerState = ProviderState::where('name', 'like', '%' . $row['estado_proveedor'] . '%')->first();

        return new Provider([
            'type_document_id' => $typeDocument->id,
            'identification' => $row['identificacion'],
            'name' => $row['nombre'],
            'address' => $row['direccion'],
            'phone' => $row['telefono'],
            'city_id' => $city->id,
            'neighborhood' => $row['barrio'],
            'observations' => $row['observaciones'],
            'state_id' => $providerState->id,
        ]);
            
        
    }
}
