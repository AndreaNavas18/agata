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
        //Verificamos que haya un tipo de instalacion primero
        if(!isset($row['installation_type']) || $row['installation_type'] == '' ){
            Log::info("No llego el tipo de instalacion");
        }else {
            Log::info("Si llego el tipo de instalacion ". $row['installation_type']);

            //Si existe un proyecto y la instalacion es propia 
            if(isset($row['nombre_proyecto']) && $row['nombre_proyecto'] != '' && $row['installation_type'] == 'Propia' ){
                $proyecto = Proyecto::where('name', 'like', '%' . $row['nombre_proyecto'] . '%')->first();
                $proyectoId = $proyecto->id;
                Log::info("Si hay proyecto");

                $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                ->addDays($row['date_service'] - 1);
                $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
                if ($customer) {
                    $customerId = $customer->id;
                    Log::info("Si llego el cliente". $customerId);
                } else {
                    Log::info("No llego ningun cliente");
                }

                $service = Service::where('name', 'like', '%' . $row['tipo_servicio'] . '%')->first();
                if($service) {
                    $serviceId = $service->id;
                    Log::info("Si llego el servicio");
                } else {
                    Log::info("No llego ningun servicio");
                }

                $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
                if($country) {
                    $countryId = $country->id;
                    Log::info("Si llego el pais");
                } else {
                    Log::info("No llego ningun pais");
                }

                $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
                if($department) {
                    $departmentId = $department->id;
                    Log::info("Si llego el departamento");
                } else {
                    Log::info("No llego ningun departamento");
                }

                $city = City::where('name', '=', $row['nombre_ciudad'])->first();
                if($city) {
                    $cityId = $city->id;
                    Log::info("Si llego la ciudad");
                } else {
                    Log::info("No llego ninguna ciudad");
                }

                $state = 'Activo';
                $nameService = $row['nombre_servicio'];
                if($nameService == null){
                    $nameService = 'No se especifico';
                    Log::info("No llego el nombre del servicio");
                }else{
                    Log::info("Si llego el nombre del servicio". $nameService);
                }

                return new CustomerService([
                    'proyecto_id' => $proyectoId,
                    'stratecsa_id' => $row['stratecsa_id'],
                    'id_serviciocliente' => $row['id_serviciocliente'],
                    'otp' => $row['otp'],
                    'name' => $nameService,
                    'customer_id' => $customerId,
                    'service_id' => $serviceId,
                    'country_id' => $countryId,
                    'department_id' => $departmentId,
                    'city_id' => $cityId,
                    'date_service' => $dateService,
                    'latitude_coordinates' => $row['latitude_coordinates'],
                    'longitude_coordinates' => $row['longitude_coordinates'],
                    'installation_type' => $row['installation_type'],
                    'description' => $row['description'],
                    'state' => $state,
                    'ip' => $row['ip'],
                    'vlan' => $row['vlan'],
                    'mascara' => $row['mascara'],
                    'gateway' => $row['gateway'],
                    'mac' => $row['mac'],
                    'BW_Download' => $row['bw_download'],
                    'BW_upload' => $row['bw_upload'],
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

            }else  if(isset($row['nombre_proyecto']) && $row['nombre_proyecto'] != '' && $row['installation_type'] == 'Terceros' ){
                //Si existe un proyecto y la instalacion es por terceros

                $proyecto = Proyecto::where('name', 'like', '%' . $row['nombre_proyecto'] . '%')->first();
                $proyectoId = $proyecto->id;
                Log::info("Si hay proyecto");

                $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                ->addDays($row['date_service'] - 1);
                $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
                if ($customer) {
                    $customerId = $customer->id;
                    Log::info("Si llego el cliente". $customerId);
                } else {
                    Log::info("No llego ningun cliente");
                }

                $service = Service::where('name', 'like', '%' . $row['tipo_servicio'] . '%')->first();
                if($service) {
                    $serviceId = $service->id;
                    Log::info("Si llego el servicio");
                } else {
                    Log::info("No llego ningun servicio");
                }

                $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
                if($country) {
                    $countryId = $country->id;
                    Log::info("Si llego el pais");
                } else {
                    Log::info("No llego ningun pais");
                }

                $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
                if($department) {
                    $departmentId = $department->id;
                    Log::info("Si llego el departamento");
                } else {
                    Log::info("No llego ningun departamento");
                }

                $city = City::where('name', 'like', '%' . $row['nombre_ciudad'] . '%')->first();
                if($city) {
                    $cityId = $city->id;
                    Log::info("Si llego la ciudad");
                } else {
                    Log::info("No llego ninguna ciudad");
                }

                $state = 'Activo';
                $nameService = $row['nombre_servicio'];
                if($nameService == null){
                    $nameService = 'No se especifico';
                    Log::info("No llego el nombre del servicio");
                }else{
                    Log::info("Si llego el nombre del servicio". $nameService);
                }

                if(isset($row['nombre_proveedor']) && $row['nombre_proveedor'] != '' ){
                    $provider = Provider::where('name', 'like', '%' . $row['nombre_proveedor'] . '%')->first();
                    $providerId = $provider->id;
                    Log::info("Si hay proveedor");
                }
        
                return new CustomerService([
                    'proyecto_id' => $proyectoId,
                    'provider_id' => $providerId,
                    'stratecsa_id' => $row['stratecsa_id'],
                    'id_serviciocliente' => $row['id_serviciocliente'],
                    'otp' => $row['otp'],
                    'name' => $nameService,
                    'customer_id' => $customerId,
                    'service_id' => $serviceId,
                    'country_id' => $countryId,
                    'department_id' => $departmentId,
                    'city_id' => $cityId,
                    'date_service' => $dateService,
                    'latitude_coordinates' => $row['latitude_coordinates'],
                    'longitude_coordinates' => $row['longitude_coordinates'],
                    'installation_type' => $row['installation_type'],
                    'description' => $row['description'],
                    'state' => $state,
                    'ip' => $row['ip'],
                    'vlan' => $row['vlan'],
                    'mascara' => $row['mascara'],
                    'gateway' => $row['gateway'],
                    'mac' => $row['mac'],
                    'BW_Download' => $row['bw_download'],
                    'BW_upload' => $row['bw_upload'],
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

            }else if(!isset($row['nombre_proyecto']) && $row['installation_type'] == 'Propia' ){
                //Si no existe un proyecto y la instalacion es propia
                $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                ->addDays($row['date_service'] - 1);
                $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
                if ($customer) {
                    $customerId = $customer->id;
                    Log::info("Si llego el cliente". $customerId);
                } else {
                    Log::info("No llego ningun cliente");
                }

                $service = Service::where('name', 'like', '%' . $row['tipo_servicio'] . '%')->first();
                if($service) {
                    $serviceId = $service->id;
                    Log::info("Si llego el servicio");
                } else {
                    Log::info("No llego ningun servicio");
                }

                $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
                if($country) {
                    $countryId = $country->id;
                    Log::info("Si llego el pais");
                } else {
                    Log::info("No llego ningun pais");
                }

                $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
                if($department) {
                    $departmentId = $department->id;
                    Log::info("Si llego el departamento");
                } else {
                    Log::info("No llego ningun departamento");
                }

                $city = City::where('name', 'like', '%' . $row['nombre_ciudad'] . '%')->first();
                if($city) {
                    $cityId = $city->id;
                    Log::info("Si llego la ciudad");
                } else {
                    Log::info("No llego ninguna ciudad");
                }

                $state = 'Activo';
                $nameService = $row['nombre_servicio'];
                if($nameService == null){
                    $nameService = 'No se especifico';
                    Log::info("No llego el nombre del servicio");
                }else{
                    Log::info("Si llego el nombre del servicio". $nameService);
                }

                return new CustomerService([
                    'stratecsa_id' => $row['stratecsa_id'],
                    'id_serviciocliente' => $row['id_serviciocliente'],
                    'otp' => $row['otp'],
                    'name' => $nameService,
                    'customer_id' => $customerId,
                    'service_id' => $serviceId,
                    'country_id' => $countryId,
                    'department_id' => $departmentId,
                    'city_id' => $cityId,
                    'date_service' => $dateService,
                    'latitude_coordinates' => $row['latitude_coordinates'],
                    'longitude_coordinates' => $row['longitude_coordinates'],
                    'installation_type' => $row['installation_type'],
                    'description' => $row['description'],
                    'state' => $state,
                    'ip' => $row['ip'],
                    'vlan' => $row['vlan'],
                    'mascara' => $row['mascara'],
                    'gateway' => $row['gateway'],
                    'mac' => $row['mac'],
                    'BW_Download' => $row['bw_download'],
                    'BW_upload' => $row['bw_upload'],
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

            }else if(!isset($row['nombre_proyecto']) && $row['installation_type'] == 'Terceros' ){
                //Si no existe un proyecto y la instalacion es por terceros
                $dateService = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                ->addDays($row['date_service'] - 1);
                $customer = Customer::where('name', 'like', '%' . $row['nombre_cliente'] . '%')->first();
                if ($customer) {
                    $customerId = $customer->id;
                    Log::info("Si llego el cliente". $customerId);
                } else {
                    Log::info("No llego ningun cliente");
                }

                $service = Service::where('name', 'like', '%' . $row['tipo_servicio'] . '%')->first();
                if($service) {
                    $serviceId = $service->id;
                    Log::info("Si llego el servicio");
                } else {
                    Log::info("No llego ningun servicio");
                }

                $country = Country::where('name', 'like', '%' . $row['nombre_pais'] . '%')->first();
                if($country) {
                    $countryId = $country->id;
                    Log::info("Si llego el pais");
                } else {
                    Log::info("No llego ningun pais");
                }

                $department = Department::where('name', 'like', '%' . $row['nombre_departamento'] . '%')->first();
                if($department) {
                    $departmentId = $department->id;
                    Log::info("Si llego el departamento");
                } else {
                    Log::info("No llego ningun departamento");
                }

                $city = City::where('name', 'like', '%' . $row['nombre_ciudad'] . '%')->first();
                if($city) {
                    $cityId = $city->id;
                    Log::info("Si llego la ciudad");
                } else {
                    Log::info("No llego ninguna ciudad");
                }

                $state = 'Activo';
                $nameService = $row['nombre_servicio'];
                if($nameService == null){
                    $nameService = 'No se especifico';
                    Log::info("No llego el nombre del servicio");
                }else{
                    Log::info("Si llego el nombre del servicio". $nameService);
                }

                if(isset($row['nombre_proveedor']) && $row['nombre_proveedor'] != '' ){
                    $provider = Provider::where('name', 'like', '%' . $row['nombre_proveedor'] . '%')->first();
                    $providerId = $provider->id;
                    Log::info("Si hay proveedor");
                }
        
                return new CustomerService([
                    'provider_id' => $providerId,
                    'stratecsa_id' => $row['stratecsa_id'],
                    'id_serviciocliente' => $row['id_serviciocliente'],
                    'otp' => $row['otp'],
                    'name' => $nameService,
                    'customer_id' => $customerId,
                    'service_id' => $serviceId,
                    'country_id' => $countryId,
                    'department_id' => $departmentId,
                    'city_id' => $cityId,
                    'date_service' => $dateService,
                    'latitude_coordinates' => $row['latitude_coordinates'],
                    'longitude_coordinates' => $row['longitude_coordinates'],
                    'installation_type' => $row['installation_type'],
                    'description' => $row['description'],
                    'state' => $state,
                    'ip' => $row['ip'],
                    'vlan' => $row['vlan'],
                    'mascara' => $row['mascara'],
                    'gateway' => $row['gateway'],
                    'mac' => $row['mac'],
                    'BW_Download' => $row['bw_download'],
                    'BW_upload' => $row['bw_upload'],
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

    }

}
