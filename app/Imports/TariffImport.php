<?php

namespace App\Imports;

use App\Models\Commercial\CommercialTariff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Commercial\CommercialTypeService;
use App\Models\Commercial\CommercialBandwidth;

class TariffImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $typeService = CommercialTypeService::where('name', '=', $row['tipo_de_servicio'])->first();
        $bandwidth = CommercialBandwidth::where('name', 'like', '%' . $row['velocidad'] . '%')
        ->whereHas('city', function ($query) use ($row) {
            $query->where('name', '=', $row['nombre_de_la_ciudad']);
        })->firstOrFail(); 

        return new CommercialTariff([
            'commercial_type_service_id' => $typeService->id,
            'bandwidth_id' => $bandwidth->id,
            'recurring_value_12' => $row['mrc12meses'],
            'recurring_value_24' => $row['mrc24meses'],
            'recurring_value_36' => $row['mrc36meses'],
            'value_mbps_12' =>  $row['nrc12meses'],
            'value_mbps_24' =>  $row['nrc24meses'],
            'value_mbps_36' =>  $row['nrc36meses'],
        ]);
       
        
    }
}
