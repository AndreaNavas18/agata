<?php

namespace App\Imports;

use App\Models\Customers\CustomerService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Customers\Customer;
use App\Models\General\Proyecto;
use App\Models\General\Service;
use App\Models\General\Country;
use App\Models\General\Department;
use App\Models\General\City;
use App\Models\Providers\Provider;

class CustomerServiceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                            ->addDays($row['date_service'] - 1); // Restar 1 porque Excel cuenta los días desde el 1 de enero de 1900
        // $dateService = Carbon::createFromFormat('Y-m-d', $row['date_service']);
        Log::info($dateService);

        //  Busca el ID del cliente
        $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
        // Busca el ID del proyecto

        if(isset($row['nombre_proyecto']) && $row['nombre_proyecto'] != '' ){
            $proyecto = Proyecto::where('name', 'like', '%' . $row['nombre_proyecto'] . '%')->first();
            $proyectoId = $proyecto->id;
            Log::info("Si hay proyecto");
            return new CustomerService([
                'proyecto_id' => $proyectoId,
            ]);
        }
        
        // Busca el ID del servicio
        $service = Service::where('name', 'like', '%' . $row['nombre_servicio'] . '%')->first();
        // Busca el ID del país
        $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
        // Busca el ID del departamento
        $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
        // Busca el ID de la ciudad
        $city = City::where('name', 'like', '%' . $row['nombre_ciudad'] . '%')->first();
        // Busca el ID del proveedor

        if(isset($row['nombre_proveedor']) && $row['nombre_proveedor'] != '' ){
            $provider = Provider::where('name', 'like', '%' . $row['nombre_proveedor'] . '%')->first();
            $providerId = $provider->id;

            return new CustomerService([
                'provider_id' => $providerId,
            ]);
        }

            return new CustomerService([
                'stratecsa_id' => $row['stratecsa_id'],
                'id_serviciocliente' => $row['id_serviciocliente'],
                'otp' => $row['otp'],
                'customer_id' => $customer->id,
                'service_id' => $service->id,
                'country_id' => $country->id,
                'department_id' => $department->id,
                'city_id' => $city->id,
                'date_service' => $dateService,
                'latitude_coordinates' => $row['latitude_coordinates'],
                'longitude_coordinates' => $row['longitude_coordinates'],
                'installation_type' => $row['installation_type'],
                'description' => $row['description'],
                'state' => $row['state'],
                'ip' => $row['ip'],
                'vlan' => $row['vlan'],
                'mascara' => $row['mascara'],
                'gateway' => $row['gateway'],
                'mac' => $row['mac'],
                'BW_Download' => $row['BW_Download'],
                'BW_upload' => $row['BW_upload'],
                'ip_vpn' => $row['ip_vpn'],
                'tipo_vpn' => $row['tipo_vpn'],
                'user_vpn' => $row['user_vpn'],
                'password_vpn' => $row['password_vpn'],
                'user_tunel' => $row['user_tunel'],
                'id_tunel' => $row['id_tunel'],
                'tecnologia' => $row['tecnologia'],
                'equipo' => $row['equipo'],
                'modelo' => $row['modelo'],
                'serial' => $row['serial'],
                'activo_fijo' => $row['activo_fijo'],
            ]);
            
        
    }
}
