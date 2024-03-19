<?php

namespace App\Models\Customers;

use App\Models\BaseModel;
use App\Models\Customers\CustomerService;

class CustomerServiceFile extends BaseModel {

	protected $table = 'customers_services_files';
	protected $fillable = [
        'slug',
        'path',
        'name_original',
        'customers_services_id'
    ];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeName($query, $name)
    {
    	return $query->where('name', $name);
    }

    public function customerServices()
    {
        return $this->belongsTo(CustomerService::class, 'customers_services_id');
    }


}