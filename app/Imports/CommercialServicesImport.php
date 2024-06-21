<?php

namespace App\Imports;

use App\Models\Commercial\CommercialTypeService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class CommercialServicesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CommercialTypeService([
            'name' => $row['nombre_del_servicio'],
        ]);
            
        
    }
}
