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
        //Mapeo de la fecha, ya que el formato que manda excel es distinto
        $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                            ->addDays($row['date_service'] - 1); // Restar 1 porque Excel cuenta los días desde el 1 de enero de 1900
        // $dateService = Carbon::createFromFormat('Y-m-d', $row['date_service']);
        Log::info($dateService);

        //Mapeo de los datos que guardan id en la base de datos, pero por le excel llegan como nombres

        $idsRelations = [];

        $nullableRelations = [
            'proyecto' => 'nombre_proyecto',
            'provider' => 'nombre_proveedor',
        ];

        $relationNamespaces = [
            'proyecto' => 'App\\Models\\General\\',
            'provider' => 'App\\Models\\Providers\\',
        ];
        

        foreach ($nullableRelations as $relation => $columnName) {
            if (!isset($row[$columnName]) || $row[$columnName] === '') {
                $idsRelations[$relation . '_id'] = null;
            } elseif ($row[$columnName] === '0') {
                $idsRelations[$relation . '_id'] = null;
            } else {
                $namespace = $relationNamespaces[$relation]; // Obtiene el namespace correspondiente para la relación
                $modelName = $namespace . ucfirst($relation); 
                $record = $modelName::where('name', 'like', '%' . $row[$columnName] . '%')->first();
                if ($record) {
                    $idsRelations[$relation . '_id'] = $record->id;
                } else {
                    Log::error("$relation no encontrado para el nombre: " . $row[$columnName]);
                    return null;
                }
            }

        }
        Log::info("Valor de proyecto_id después del bucle de relaciones: " . $idsRelations['proyecto_id']);

        $idsFields =[];

        $nullableFields = [
            'latitude_coordinates' => 'latitude_coordinates',
            'longitude_coordinates' => 'longitude_coordinates',
            'description' => 'description',
            'ip' => 'ip',
            'vlan' => 'vlan',
            'mascara' => 'mascara',
            'gateway' => 'gateway',
            'mac' => 'mac',
            'ancho_de_banda' => 'ancho_de_banda',
            'ip_vpn' => 'ip_vpn',
            'tipo_vpn' => 'tipo_vpn',
            'user_vpn' => 'user_vpn',
            'password_vpn' => 'password_vpn',
            'user_tunel' => 'user_tunel',
            'id_tunel' => 'id_tunel',
            'tecnologia' => 'tecnologia',
            'equipo' => 'equipo',
            'modelo' => 'modelo',
            'serial' => 'serial',
            'activo_fijo' => 'activo_fijo',
        ];

         // Busca los IDs correspondientes para los campos que pueden ser nulos
         foreach ($nullableFields as $field => $columnName) {
            // $idsFields[$field] = !empty($row[$columnName]) ? $row[$columnName] : null;

            // Verifica si el campo en el archivo Excel está vacío
            $value = !empty($row[$columnName]) ? $row[$columnName] : null;
            // Verifica si el campo es uno de los campos de relación
            if (array_key_exists($field, $idsRelations)) {
                // Si es uno de los campos de relación, asegúrate de que el valor sea null si el campo en el archivo Excel está vacío
                $idsFields[$field] = $value !== '' ? $value : null;
            } else {
                // Si no es un campo de relación, simplemente asigna el valor del archivo Excel
                $idsFields[$field] = $value;
            }
        }

        
        //  // Busca el ID del cliente
         $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
         // Busca el ID del proyecto
         $proyecto = Proyecto::where('name', 'like', '%' . $row['nombre_proyecto'] . '%')->first();
         // Busca el ID del servicio
         $service = Service::where('name', 'like', '%' . $row['nombre_servicio'] . '%')->first();
         // Busca el ID del país
         $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
         // Busca el ID del departamento
         $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
         // Busca el ID de la ciudad
         $city = City::where('name', 'like', '%' . $row['nombre_ciudad'] . '%')->first();
         // Busca el ID del proveedor
         $provider = Provider::where('name', 'like', '%' . $row['nombre_proveedor'] . '%')->first();
 

        //  // Verifica si se encontró todo
        //  if ($customer && $proyecto && $service && $country && $department && $city && $provider) {
        //     // Si es verdaro le asignamos el ID a cada campo
        //     return new CustomerService([
        //         'stratecsa_id' => $row['stratecsa_id'],
        //         'id_serviciocliente' => $row['id_serviciocliente'],
        //         'otp' => $row['otp'],
        //         'customer_id' => $customer->id,
        //         'proyecto_id' => $proyecto->id,
        //         'service_id' => $service->id,
        //         'country_id' => $country->id,
        //         'department_id' => $department->id,
        //         'city_id' => $city->id,
        //         'date_service' => $dateService,
        //         'latitude_coordinates' => $row['latitude_coordinates'],
        //         'longitude_coordinates' => $row['longitude_coordinates'],
        //         'installation_type' => $row['installation_type'],
        //         'provider_id' => $provider->id,
        //         'description' => $row['description'],
        //         'state' => $row['state'],
        //         'ip' => $row['ip'],
        //         'vlan' => $row['vlan'],
        //         'mascara' => $row['mascara'],
        //         'gateway' => $row['gateway'],
        //         'mac' => $row['mac'],
        //         'ancho_de_banda' => $row['ancho_de_banda'],
        //         'ip_vpn' => $row['ip_vpn'],
        //         'tipo_vpn' => $row['tipo_vpn'],
        //         'user_vpn' => $row['user_vpn'],
        //         'password_vpn' => $row['password_vpn'],
        //         'user_tunel' => $row['user_tunel'],
        //         'id_tunel' => $row['id_tunel'],
        //         'tecnologia' => $row['tecnologia'],
        //         'equipo' => $row['equipo'],
        //         'modelo' => $row['modelo'],
        //         'serial' => $row['serial'],
        //         'activo_fijo' => $row['activo_fijo'],
        //     ]);
        // } else {
        //     // Si no se encontró alguna relación, maneja el caso según tus necesidades
        //     // Registra un error en el log y devuelve null en este ejemplo
        //     Log::error("Alguna relación no encontrada para los datos: " . print_r($row, true));
        //     return null;
        // }

        return new CustomerService([
            'stratecsa_id' => $row['stratecsa_id'],
            'id_serviciocliente' => $row['id_serviciocliente'],
            'otp' => $row['otp'],
            'customer_id' => $customer->id,
            'proyecto_id' => $idsRelations['proyecto_id'],
            'service_id' => $service->id,
            'country_id' => $country->id,
            'department_id' => $department->id,
            'city_id' => $city->id,
            'date_service' => $dateService,
            'latitude_coordinates' => $idsFields['latitude_coordinates'],
            'longitude_coordinates' => $idsFields['longitude_coordinates'],
            'installation_type' => $row['installation_type'],
            'provider_id' => $idsRelations['provider_id'],
            'description' => $idsFields['description'],
            'state' => $row['state'],
            'ip' => $idsFields['ip'],
            'vlan' => $idsFields['vlan'],
            'mascara' => $idsFields['mascara'],
            'gateway' => $idsFields['gateway'],
            'mac' => $idsFields['mac'],
            'ancho_de_banda' => $idsFields['ancho_de_banda'],
            'ip_vpn' => $idsFields['ip_vpn'],
            'tipo_vpn' => $idsFields['tipo_vpn'],
            'user_vpn' => $idsFields['user_vpn'],
            'password_vpn' => $idsFields['password_vpn'],
            'user_tunel' => $idsFields['user_tunel'],
            'id_tunel' => $idsFields['id_tunel'],
            'tecnologia' => $idsFields['tecnologia'],
            'equipo' => $idsFields['equipo'],
            'modelo' => $idsFields['modelo'],
            'serial' => $idsFields['serial'],
            'activo_fijo' => $idsFields['activo_fijo'],
        ]);
    }
}
