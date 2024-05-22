<?php

namespace App\Models\Customers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use App\Models\General\Proyecto;
use App\Models\Customers\CustomerServiceFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CustomerService extends BaseModel {

    protected $table = 'customers_services';
    protected $fillable = [
        'stratecsa_id',
        'id_serviciocliente',
        'otp',
        'name',
        'customer_id',
        'proyecto_id',
        'service_id',
        'country_id',
        'department_id',
        'city_id',
        'date_service',
        'latitude_coordinates',
        'longitude_coordinates',
        'installation_type',
        'provider_id',
        'description',
        'state',
        'ip',
        'vlan',
        'mascara',
        'gateway',
        'mac',
        'BW_Download',
        'BW_upload',
        'ip_vpn',
        'tipo_vpn',
        'user_vpn',
        'password_vpn',
        'user_tunel',
        'id_tunel',
        'tecnologia',
        'equipo',
        'modelo',
        'serial',
        'activo_fijo'
    ];
    protected $guarded = [];


    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
        return $query->where('identification', 'like', '%' . $identification . '%');
    }

    public function scopeDescription($query, $description)
    {
        return $query->where('description', 'like', '%' . $description . '%');
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeCustomerId($query, $customerId)
    {
        return $query->where('customer_id',$customerId);
    }

    public function scopeProjectId($query, $projectId)
    {
        return $query->where('proyecto_id', $projectId);
    }

    public function scopeProviderId($query, $providerId)
    {
        return $query->where('provider_id',$providerId);
    }

    public function scopeInstallationType($query, $installationtype)
    {
        return $query->where('installation_type',$installationtype);
    }

    public function scopeServiceId($query, $serviceId)
    {
        return $query->where('service_id',$serviceId);
    }

    public function scopeCityId($query, $cityId)
    {
        return $query->where('city_id',$cityId);
    }

    public function scopeStratecsaId($query, $stratecsaId)
    {
        return $query->where('stratecsa_id', 'like', '%' . $stratecsaId . '%');
    }

    
    public function scopeOtp($query, $otp)
    {
        return $query->where('otp', 'like', '%' . $otp . '%');
    }

    public function scopeDateBetween($query, $date_service, $date_final)
    {
        $startDate = Carbon::parse($date_service)->startOfDay();
        $endDate = Carbon::parse($date_final)->startOfDay();

        return $query->whereBetween('date_service', [$startDate, $endDate]);
    }

    public function scopeDateBetweenAndCurrent($query, $date_service)
    {
        return $query->whereDate('date_service', '>=', $date_service)
            ->whereDate('date_service', '<=', Carbon::now());
    }

    public function scopeCreated_at($query, $created_at)
    {
        return $query->where('created_at', $created_at);
    }



    /* *************************************************************
	 * relaciones
	* *************************************************************/

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'customer_service_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function files()
    {
        return $this->hasMany(CustomerServiceFile::class, 'customers_services_id');
    }



    /* *************************************************************
	 * funciones
	* *************************************************************/


    //Buscar Servicio
    public static function buscarServicio($data, $id, $tipo)
    {

        if ($tipo == 'customer') {
            $customerServices = CustomerService::customerId($id);
        } elseif ($tipo == 'provider') {
            $customerServices = CustomerService::providerId($id);
        }else{
            $customerServices = CustomerService::query();
        }

        $customerServices = $customerServices->with(
            'customer',
            'customer.typeDocument:id,name',
            'service',
            'provider:id,name',
            'city',
            'city.department',
            'proyecto',
        );

        if (isset($data['start_date']) && !is_null($data['start_date'])) {
            $customerServices = $customerServices->dateBetweenAndCurrent($data['start_date']);
        }

        if (
            isset($data['start_date']) && !is_null($data['start_date']) &&
            isset($data['final_date']) && !is_null($data['final_date'])
        ) {
            $customerServices = $customerServices->dateBetween($data['start_date'], $data['final_date']);
        }

        if (isset($data['proyecto_id']) && !is_null($data['proyecto_id'])) {
            $customerServices = $customerServices->projectId($data['proyecto_id']);
        }

        if (isset($data['name']) && !is_null($data['name'])) {
            $customerServices = $customerServices->name($data['name']);
        }

        if (isset($data['description']) && !is_null($data['description'])) {
            $customerServices = $customerServices->description($data['description']);
        }

        if (isset($data['installation_type']) && !is_null($data['installation_type'])) {
            $customerServices = $customerServices->InstallationType($data['installation_type']);
        }

        if (isset($data['service_id']) && !is_null($data['service_id'])) {
            $customerServices = $customerServices->serviceId($data['service_id']);
        }

        if (isset($data['provider_id']) && !is_null($data['provider_id'])) {
            $customerServices = $customerServices->providerId($data['provider_id']);
        }

        if (isset($data['customer_id']) && !is_null($data['customer_id'])) {
            $customerServices = $customerServices->customerId($data['customer_id']);
        }

        if (isset($data['department_id']) && !is_null($data['department_id'])) {
            $customerServices = $customerServices->whereHas('city', function ($q) use ($data) {
                return $q->where('general_cities.department_id', $data['department_id']);
            });
        }

        if (isset($data['city_id']) && !is_null($data['city_id'])) {
            $customerServices = $customerServices->cityId($data['city_id']);
        }

        if (isset($data['id_stratecsa']) && !is_null($data['id_stratecsa'])) {
            $customerServices = $customerServices->stratecsaId($data['id_stratecsa']);
        }

        if (isset($data['otp']) && !is_null($data['otp'])) {
            $customerServices = $customerServices->otp($data['otp']);
        }

        return $customerServices;
    }


        //Obtener todos los servicios del cliente que pertenezcan a un proyecto
    public function obtenerServiciosClienteProyecto($customer_id, $proyecto_id)
    
        {
            if ($proyecto_id === "Null") {
                Log::info($customer_id);
                $servicesCustomer = CustomerService::where('customer_id', $customer_id)
            ->whereNull('proyecto_id')
            ->get();
            }

          else{  
            $servicesCustomer = CustomerService::where('customer_id', $customer_id)
                            ->where('proyecto_id', $proyecto_id)
                            ->get();
          }
            return $servicesCustomer;
        }   


    // public static function buscar($data, $id, $tipo)
    // {
    //     if ($tipo == 'customer') {
    //         $customerServices = CustomerService::customerId($id);
    //     } else {
    //         $customerServices = CustomerService::providerId($id);
    //     }

    //     $customerServices = $customerServices->with(
    //         'customer',
    //         'customer.typeDocument:id,name',
    //         'service',
    //         'provider:id,name',
    //         'city',
    //         'city.department',
    //     );

    //     if ( isset($data['start_date']) && !is_null($data['start_date']) &&
    //         isset($data['final_date']) && !is_null($data['final_date']))
    //         {
    //         $customerServices = $customerServices->dateBetween($data['start_date'], $data['final_date']);
    //         }

    //     if (isset($data['description']) && !is_null($data['description'])) {
    //         $customerServices = $customerServices->name($data['description']);
    //     }
    
    //     if (isset($data['installation_type']) && !is_null($data['installation_type'])) {
    //         $customerServices = $customerServices->InstallationType($data['installation_type']);
    //     }

    //     if (isset($data['service_id']) && !is_null($data['service_id'])) {
    //         $customerServices = $customerServices->serviceId($data['service_id']);
    //     }

    //     if (isset($data['provider_id']) && !is_null($data['provider_id'])) {
    //         $customerServices = $customerServices->providerId($data['provider_id']);
    //     }

    //     if (isset($data['customer_id']) && !is_null($data['customer_id'])) {
    //         $customerServices = $customerServices->customerId($data['customer_id']);
    //     }

    //     if (isset($data['department_id']) && !is_null($data['department_id'])) {
    //         $customerServices = $customerServices->whereHas('city', function ($q) use ($data) {
    //             return $q->where('general_cities.department_id', $data['department_id']);
    //         });
    //     }

    //     if (isset($data['city_id']) && !is_null($data['city_id'])) {
    //         $customerServices = $customerServices->cityId($data['city_id']);
    //     }

    //     return $customerServices;
    // }


}






