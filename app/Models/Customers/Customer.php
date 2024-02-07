<?php

namespace App\Models\Customers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\Customers\CustomerState;
use App\Models\Customers\CustomerContact;
use App\Models\Customers\CustomerService;
use App\Models\General\TypeDocument;

class Customer extends BaseModel {

	protected $table = 'customers';
	protected $fillable = [];
	protected $guarded = [];

    /* *************************************************************
	 * scopes
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }


    /* *************************************************************
	 * relaciones
	* *************************************************************/
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(CustomerState::class, 'state_id');
    }

    public function customerContacs()
    {
        return $this->hasMany(CustomerContact::class, 'customer_id');
    }

    public function customerServices()
    {
        return $this->hasMany(CustomerService::class, 'customer_id');
    }


}






