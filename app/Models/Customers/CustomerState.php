<?php

namespace App\Models\Customers;

use App\Models\BaseModel;

class CustomerState extends BaseModel {

	protected $table = 'customers_states';
	protected $fillable = [];
	protected $guarded = [];


    /* *************************************************************
	 * S C O P E S
	* *************************************************************/
    public function scopeIdentification($query, $identification)
    {
    	return $query->where('identification', 'like', '%'.$identification.'%');
    }
}






