<?php

namespace App\Models\Providers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\General\TypeContact;

class ProviderContact extends BaseModel {

	protected $table = 'providers_contacts';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }

    public function scopeProviderId($query, $providerId)
    {
    	return $query->where('provider_id',$providerId);
    }

    public function scopeCustomerId($query, $customerId)
    {
    	return $query->where('customer_id',$customerId);
    }

    /* *************************************************************
	 * relaciones
	* *************************************************************/
    public function typeContact()
    {
        return $this->belongsTo(TypeContact::class, 'type_contact_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}






