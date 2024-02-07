<?php

namespace App\Models\Customers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\General\TypeContact;

class CustomerContact extends BaseModel {

	protected $table = 'customers_contacts';
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

    public function scopeTypeContactId($query, $contactId)
    {
    	return $query->where('type_contact_id',$contactId);
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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}






