<?php

namespace App\Imports;

use App\Models\Commercial\CommercialBandwidth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\General\City;
use App\Models\General\Department;

class BandwidthImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $name = $row['velocidad'] . " MBPS";
        // Verifica si el valor de velocidad ya incluye "MBPS", si no, lo agrega
        if (!str_contains(strtolower($row['velocidad']), 'mbps')) {
            $name = $row['velocidad'] . " MBPS";
        } else {
            $name = strtoupper($row['velocidad']);
        }

        $department = Department::where('name', '=', $row['departamento'])->first();
        $city = City::where('name', '=', $row['ciudad'])->first();

        return new CommercialBandwidth([
            'name' => $name,
            'department_id' => $department->id,
            'city_id' => $city->id,
        ]);
            
        
    }
}
