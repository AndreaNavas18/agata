<?php

namespace App\Imports;

use App\Models\Customers\CustomerService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CustomerServiceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                            ->addDays($row['date_service'] - 1); // Restar 1 porque Excel cuenta los días desde el 1 de enero de 1900
        // $dateService = Carbon::createFromFormat('Y-m-d', $row['date_service']);
        Log::info($dateService);
        // Aquí defines cómo deben ser mapeados los datos del archivo Excel a los campos de tu modelo CustomerService
        return new CustomerService([
            'stratecsa_id' => $row['stratecsa_id'],
            'id_serviciocliente' => $row['id_serviciocliente'],
            'otp' => $row['otp'],
            'customer_id' => $row['customer_id'],
            'proyecto_id' => $row['proyecto_id'],
            'service_id' => $row['service_id'],
            'country_id' => $row['country_id'],
            'department_id' => $row['department_id'],
            'city_id' => $row['city_id'],
            'date_service' => $dateService,
            'latitude_coordinates' => $row['latitude_coordinates'],
            'longitude_coordinates' => $row['longitude_coordinates'],
            'installation_type' => $row['installation_type'],
            'provider_id' => $row['provider_id'],
            'description' => $row['description'],
            'state' => $row['state'],
        ]);
    }
}
