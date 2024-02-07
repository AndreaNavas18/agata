<?php

namespace App\Models\Providers;

use App\Models\BaseModel;
use App\Models\General\City;
use App\Models\Providers\ProviderState;
use App\Models\Providers\ProviderContact;
use App\Models\Customers\CustomerService;
use App\Models\General\TypeDocument;

class Provider extends BaseModel {

	protected $table = 'providers';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
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
        return $this->belongsTo(ProviderState::class, 'state_id');
    }

    public function contacs()
    {
        return $this->hasMany(ProviderContact::class, 'provider_id');
    }

    public function services()
    {
        return $this->hasMany(CustomerService::class, 'provider_id');
    }
}






