<?php

namespace App\Models\Customers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\General\Service;
use App\Models\Providers\Provider;
use App\Models\Tickets\Ticket;
use App\Models\General\Proyecto;

class CustomerService extends BaseModel {

	protected $table = 'customers_services';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }

    public function scopeCustomerId($query, $customerId)
    {
    	return $query->where('customer_id',$customerId);
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



    /* *************************************************************
	 * funciones
	* *************************************************************/

    public static function buscar($data,$id,$tipo) {
        if ($tipo=='customer') {
            $customerServices= CustomerService::customerId($id);
        } else {
            $customerServices= CustomerService::providerId($id);
        }

        $customerServices= $customerServices->with(
            'customer',
            'customer.typeDocument:id,name',
            'service',
            'provider:id,name',
            'city',
            'city.department',
        );

        if (isset($data['start_date']) && !is_null($data['start_date']) &&
            isset($data['final_date']) && !is_null($data['final_date'])) {
            $customerServices = $customerServices->dateBetween($data['start_date'], $data['final_date']);
        }

        if (isset($data['description']) && !is_null($data['description']) ) {
            $customerServices = $customerServices->name($data['description']);
        }

        if (isset($data['installation_type']) && !is_null($data['installation_type']) ) {
            $customerServices = $customerServices->InstallationType($data['installation_type']);
        }

        if (isset($data['service_id']) && !is_null($data['service_id']) ) {
            $customerServices = $customerServices->serviceId($data['service_id']);
        }

        if (isset($data['provider_id']) && !is_null($data['provider_id']) ) {
            $customerServices = $customerServices->providerId($data['provider_id']);
        }

        if (isset($data['customer_id']) && !is_null($data['customer_id']) ) {
            $customerServices = $customerServices->customerId($data['customer_id']);
        }

        if (isset($data['department_id']) && !is_null($data['department_id']) ) {
            $customerServices = $customerServices->whereHas('city', function($q) use($data) {
                return $q->where('general_cities.department_id',$data['department_id']);
            });
        }

        if (isset($data['city_id']) && !is_null($data['city_id']) ) {
            $customerServices = $customerServices->cityId($data['city_id']);
        }

        return $customerServices;
    }
}






